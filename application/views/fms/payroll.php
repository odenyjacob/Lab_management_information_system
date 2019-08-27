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
			    		<h3 class="panel-title" align="center"> PAYROLL REPORT :::</h3>  
			  		</div>
			  		<div class="panel-body" style="overflow-y: scroll; min-height: 10;"> 
			  			<div class="pull-right"> Export : <i class="fa fa-file-excel-o fa-2x"> </i> <i class="fa fa-file-word-o fa-2x"> </i> </div> 
			  			
			  			<fieldset>  
			  			<?php echo validation_errors(); ?>
				
				        <?php $attributes = array('class' => 'form-horizontal row-border', 'id' => 'profile');?>	
						<?php echo form_open('', $attributes); 
					
						//echo "<div id='result' style='display: none'>";					
						echo "<div class='col-md-12'>";	?>
			  			<div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-hover ">
						<?php
						
						echo "<h3> Payroll Report</h3><hr>";
						echo "<thead>
				        		<tr> 
						        	<th><center># </center></th>
						        	<th><center>First Name </center></th>
						        	<th><center>Last Name </center></th>
						        	<th><center>Basic Salary </center></th>
						        	<th><center>House Allowance </center></th>
						        	<th><center>Medical Allowance</center></th>
						        	<th><center>Over Time</center></th>
						        	<th><center>Travel Reimbursement</center></th>
						        	<th><center>Arrears</center></th>
						        	<th><center>Supplement 1</center></th>
						        	<th><center>Supplement 2 </center></th>
						        	<th><center>Supplement 3 </center></th>
						        	<th><center> PAYE </center></th>
						        	<th><center>Bank Loan </center></th>
						        	<th><center>Medical Contribution </center></th>
						        	<th><center>SACCO Loan </center></th>
						        	<th><center>Cash Advance </center></th>
						        	<th><center>Student Loan </center></th>
						        	<th><center>SSF </center></th>
						        	<th><center>Other Deductions 1 </center></th>
						        	<th><center>Other Deductions 2 </center></th>
						        	
				        		</tr></thead>";
							foreach($report as $row){
								$count = count($row); 
								$final_basic = 0; 
								if($row){
                        		echo" 				        	
				        	
				        	<tr> <td>{$row->empNumber}</td> <td> {$row->FName}</td> <td> {$row->LName} </td>  <td> {$row->basic_salary} </td>   <td> {$row->house_allowance} </td>  <td>{$row->medical_allowance} </td> <td> {$row->over_time} </td>  <td> {$row->travel_reimbursement} </td>  <td> {$row->arrears} </td>  <td>{$row->supplement1} </td>	
				        			<td>{$row->supplement2} </td> <td> {$row->supplement3}</td> <td> </td><td> {$row->bank_loan} </td><td>  {$row->medical_contribution}</td><td> {$row->sacco_loan} </td><td> {$row->cash_advance} </td><td> {$row->student_loan} </td><td> {$row->ssf} </td><td> {$row->otherdeductions1} </td><td>{$row->otherdeductions2} </td>
							 </tr>
				        	"; $count++; }else{
				        		echo "No approvals yet. Check back later!<br> ";
								break;
				        	}} echo// "<tr> <td> $count </td> <td> </td> <td> </td> </tr>
						"</table></div>"; 
						
						
					
						
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