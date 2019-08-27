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
		$(".approve").click(function(event){
			event.preventDefault();
			
			var empNumber = $(this).val();
			$(this).hide();
		
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/hcm/timecard_approved",
				dataType: 'json',
				data: {
					empNumber: empNumber,	
				},
				success: function (response){
					if(response){
					alert("#" + response.empNumber + ": Time-Card Approved Successfully!");
					}else{
						alert("Something went wrong while processing. Try again later");
					}
				}
			});
		});
		
		$(".reject").click(function(event){
			event.preventDefault();
			
			var empNumber = $(this).val();
			$(this).hide();
		
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/hcm/timecard_rejected",
				dataType: 'json',
				data: {
					empNumber: empNumber,	
				},
				success: function (response){
					if(response){
					alert("#" + response.empNumber + ": Time-Card Rejected Successfully!");
					}else{
						alert("Something went wrong while processing. Try again later");
					}
				}
			});
		});
		
		$(".view").click(function(event){
			event.preventDefault();
			
			var empNumber = $(this).val();
		
			$.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "index.php/hcm/viewTc",
				dataType: 'json',
				data: {
					empNumber: empNumber,	
				},
				success: function (response){
					if(response){
						//console.log(response);
					$("#showTimecard").slideDown('3000','swing');
					
					$("#particulars").html("#" + response.empNumber + " " + response.FName + " " + response.LName);
					
					$("#available1").html(response.available1);
					$("#timeIn1").html(response.timeIn1);
					$("#timeOut1").html(response.timeOut1);
					$("#remarks1").html(response.remarks1);
					
					$("#available2").html(response.available2);
					$("#timeIn2").html(response.timeIn2);
					$("#timeOut2").html(response.timeOut2);
					$("#remarks2").html(response.remarks2);
					
					$("#available3").html(response.available3);
					$("#timeIn3").html(response.timeIn3);
					$("#timeOut3").html(response.timeOut3);
					$("#remarks3").html(response.remarks3);
					
					$("#available4").html(response.available4);
					$("#timeIn4").html(response.timeIn4);
					$("#timeOut4").html(response.timeOut4);
					$("#remarks4").html(response.remarks4);
					
					$("#available5").html(response.available5);
					$("#timeIn5").html(response.timeIn5);
					$("#timeOut5").html(response.timeOut5);
					$("#remarks5").html(response.remarks5);
					
					$("#available6").html(response.available6);
					$("#timeIn6").html(response.timeIn6);
					$("#timeOut6").html(response.timeOut6);
					$("#remarks6").html(response.remarks6);
					
					$("#available7").html(response.available7);
					$("#timeIn7").html(response.timeIn7);
					$("#timeOut7").html(response.timeOut7);
					$("#remarks7").html(response.remarks7);
					
					$("#available8").html(response.available8);
					$("#timeIn8").html(response.timeIn8);
					$("#timeOut8").html(response.timeOut8);
					$("#remarks8").html(response.remarks8);
					
					$("#available9").html(response.available9);
					$("#timeIn9").html(response.timeIn9);
					$("#timeOut9").html(response.timeOut9);
					$("#remarks9").html(response.remarks9);
					
					$("#available10").html(response.available10);
					$("#timeIn10").html(response.timeIn10);
					$("#timeOut10").html(response.timeOut10);
					$("#remarks10").html(response.remarks10);
					
					$("#available11").html(response.available11);
					$("#timeIn11").html(response.timeIn11);
					$("#timeOut11").html(response.timeOut11);
					$("#remarks11").html(response.remarks11);
					
					$("#available12").html(response.available12);
					$("#timeIn12").html(response.timeIn12);
					$("#timeOut12").html(response.timeOut12);
					$("#remarks12").html(response.remarks12);
					
					$("#available13").html(response.available13);
					$("#timeIn13").html(response.timeIn13);
					$("#timeOut13").html(response.timeOut13);
					$("#remarks13").html(response.remarks13);
					
					$("#available14").html(response.available14);
					$("#timeIn14").html(response.timeIn14);
					$("#timeOut14").html(response.timeOut14);
					$("#remarks14").html(response.remarks14);
					
					$("#available15").html(response.available15);
					$("#timeIn15").html(response.timeIn15);
					$("#timeOut15").html(response.timeOut15);
					$("#remarks15").html(response.remarks15);
					
					$("#available16").html(response.available16);
					$("#timeIn16").html(response.timeIn16);
					$("#timeOut16").html(response.timeOut16);
					$("#remarks16").html(response.remarks16);
					
					$("#available17").html(response.available17);
					$("#timeIn17").html(response.timeIn17);
					$("#timeOut17").html(response.timeOut17);
					$("#remarks17").html(response.remarks17);
					
					$("#available18").html(response.available18);
					$("#timeIn18").html(response.timeIn18);
					$("#timeOut18").html(response.timeOut18);
					$("#remarks18").html(response.remarks18);
					
					$("#available19").html(response.available19);
					$("#timeIn19").html(response.timeIn19);
					$("#timeOut19").html(response.timeOut19);
					$("#remarks19").html(response.remarks19);
					
					$("#available20").html(response.available20);
					$("#timeIn20").html(response.timeIn20);
					$("#timeOut20").html(response.timeOut20);
					$("#remarks20").html(response.remarks20);
					
					$("#available21").html(response.available21);
					$("#timeIn21").html(response.timeIn21);
					$("#timeOut21").html(response.timeOut21);
					$("#remarks21").html(response.remarks21);
					
					$("#available22").html(response.available22);
					$("#timeIn22").html(response.timeIn22);
					$("#timeOut22").html(response.timeOut22);
					$("#remarks22").html(response.remarks22);
					
					$("#available23").html(response.available23);
					$("#timeIn23").html(response.timeIn23);
					$("#timeOut23").html(response.timeOut23);
					$("#remarks23").html(response.remarks23);
					
					$("#available24").html(response.available24);
					$("#timeIn24").html(response.timeIn24);
					$("#timeOut24").html(response.timeOut24);
					$("#remarks24").html(response.remarks24);
					
					$("#available25").html(response.available25);
					$("#timeIn25").html(response.timeIn25);
					$("#timeOut25").html(response.timeOut25);
					$("#remarks25").html(response.remarks25);
					
					$("#available26").html(response.available26);
					$("#timeIn26").html(response.timeIn26);
					$("#timeOut26").html(response.timeOut26);
					$("#remarks26").html(response.remarks26);
					
					$("#available27").html(response.available27);
					$("#timeIn27").html(response.timeIn27);
					$("#timeOut27").html(response.timeOut27);
					$("#remarks27").html(response.remarks27);
					
					$("#available28").html(response.available28);
					$("#timeIn28").html(response.timeIn28);
					$("#timeOut28").html(response.timeOut28);
					$("#remarks28").html(response.remarks28);
					
					$("#available29").html(response.available29);
					$("#timeIn29").html(response.timeIn29);
					$("#timeOut29").html(response.timeOut29);
					$("#remarks29").html(response.remarks29);
					
					$("#available30").html(response.available30);
					$("#timeIn30").html(response.timeIn30);
					$("#timeOut30").html(response.timeOut30);
					$("#remarks30").html(response.remarks30);
					
					$("#available31").html(response.available31);
					$("#timeIn31").html(response.timeIn31);
					$("#timeOut31").html(response.timeOut31);
					$("#remarks31").html(response.remarks31); 
					

					
					
					
					}else{
						alert("Something went wrong while processing. Try again later");
					}
				}
			});
		});
		
		$("#toggleView").click(function(){
			$("#showTimecard").hide('slide');
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
			    		<h3 class="panel-title" align="center"> :::: TIME CARD APPROVALS :::</h3>  
			  		</div>
			  		<div class="panel-body"> 
			  			
			  			
			  			<fieldset>  
			  			<?php echo validation_errors(); ?>
				
				        <?php $attributes = array('class' => 'form-horizontal row-border', 'id' => 'profile');?>	
						<?php echo form_open('', $attributes); 
					
						//echo "<div id='result' style='display: none'>";					
						echo "<div class='col-xl-6'>";	?>
			  			<div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-hover ">
						<?php
						
						echo "<h3> Approve/Reject Time-Card </h3><hr>";
						echo "<thead>
				        		<tr> 
						        	<th><center>Employee Number </center></th>
						        	<th><center>Employee Name </center></th>
						        	<th><center>Status</center></th>
						        	<th><center>Options</center></th>
						        	<th><center>Actions</center></th>
						        	
				        		</tr>";
							foreach($approvals as $row){  
								if($row){
                        		echo" 
				        	
				        	</thead>
				        	<tr> <td>{$row->empNumber}</td> <td> {$row->FName} {$row->LName}</td> <td> {$row->status} </td> <td> <center> <button class='view btn btn-sm  $buttonclass'   value='$row->empNumber'>View</button></center> </td>  <td><center>"; if($row->status!="Approved"){echo"<button class='approve btn btn-sm  $buttonclass'   value='$row->empNumber'>Approve</button>";} else{echo "<button class='reject btn btn-sm  btn-warning'   value='$row->empNumber'>Reject</button>";} echo " </center>  </td>	 </tr>
				        	";}else{
				        		echo "No approvals yet. Check back later!<br> ";
								break;
				        	}} echo "
						</table></div>"; 
						
						
						echo br(2); echo "<div id='showTimecard' style='display: none'>";
						echo "<center> <div id='toggleView' <i class='fa fa-caret-square-o-up fa-3x'></i> </div> </center> ";
						echo "<h3> <div id='particulars'> </div> </h3><hr>";
						
						
						echo "<div class='box-body table-responsive'>
                        <table id='example1' class='table table-bordered table-hover '>
                        	
                        		
				        	<thead>
				        		<tr>
						        	<th > Date</th>
						        	<th>Availability</th>
						        	<th>Time In</th>
						        	<th>Time Out</th>
						        	<th>Remarks</th>
				        		</tr>
				        	</thead>";
							echo "
								<tr> <td> 1st</td> <td> <div id='available1'>  </div> </td>  <td><div id='timeIn1'>  </div> </td> <td> <div id='timeOut1'>  </div></td> <td><div id='remarks1'>  </div> </td>     </tr>
								<tr> <td> 2nd</td> <td> <div id='available2'>  </div> </td>  <td><div id='timeIn2'>  </div> </td> <td> <div id='timeOut2'>  </div></td> <td><div id='remarks2'>  </div> </td>     </tr>
								<tr> <td> 3rd</td> <td> <div id='available3'>  </div> </td>  <td><div id='timeIn3'>  </div> </td> <td> <div id='timeOut3'>  </div></td> <td><div id='remarks3'>  </div> </td>     </tr>
								<tr> <td> 4th</td> <td> <div id='available4'>  </div> </td>  <td><div id='timeIn4'>  </div> </td> <td> <div id='timeOut4'>  </div></td> <td><div id='remarks4'>  </div> </td>     </tr>
								<tr> <td> 5th</td> <td> <div id='available5'>  </div> </td>  <td><div id='timeIn5'>  </div> </td> <td> <div id='timeOut5'>  </div></td> <td><div id='remarks5'>  </div> </td>     </tr>
								<tr> <td> 6th</td> <td> <div id='available6'>  </div> </td>  <td><div id='timeIn6'>  </div> </td> <td> <div id='timeOut6'>  </div></td> <td><div id='remarks6'>  </div> </td>     </tr>
								<tr> <td> 7th</td> <td> <div id='available7'>  </div> </td>  <td><div id='timeIn7'>  </div> </td> <td> <div id='timeOut7'>  </div></td> <td><div id='remarks7'>  </div> </td>     </tr>
								<tr> <td> 8th</td> <td> <div id='available8'>  </div> </td>  <td><div id='timeIn8'>  </div> </td> <td> <div id='timeOut8'>  </div></td> <td><div id='remarks8'>  </div> </td>     </tr>
								<tr> <td> 9th</td> <td> <div id='available9'>  </div> </td>  <td><div id='timeIn9'>  </div> </td> <td> <div id='timeOut9'>  </div></td> <td><div id='remarks9'>  </div> </td>     </tr>
								<tr> <td> 10th</td> <td> <div id='available10'>  </div> </td>  <td><div id='timeIn10'>  </div> </td> <td> <div id='timeOut10'>  </div></td> <td><div id='remarks10'>  </div> </td>     </tr>
								<tr> <td> 11th</td> <td> <div id='available11'>  </div> </td>  <td><div id='timeIn11'>  </div> </td> <td> <div id='timeOut11'>  </div></td> <td><div id='remarks11'>  </div> </td>     </tr>
								<tr> <td> 12th</td> <td> <div id='available12'>  </div> </td>  <td><div id='timeIn14'>  </div> </td> <td> <div id='timeOut12'>  </div></td> <td><div id='remarks12'>  </div> </td>     </tr>
								<tr> <td> 13th</td> <td> <div id='available13'>  </div> </td>  <td><div id='timeIn13'>  </div> </td> <td> <div id='timeOut13'>  </div></td> <td><div id='remarks13'>  </div> </td>     </tr>
								<tr> <td> 14th</td> <td> <div id='available14'>  </div> </td>  <td><div id='timeIn14'>  </div> </td> <td> <div id='timeOut14'>  </div></td> <td><div id='remarks14'>  </div> </td>     </tr>
								<tr> <td> 15th</td> <td> <div id='available15'>  </div> </td>  <td><div id='timeIn15'>  </div> </td> <td> <div id='timeOut15'>  </div></td> <td><div id='remarks15'>  </div> </td>     </tr>
								<tr> <td> 16th</td> <td> <div id='available16'>  </div> </td>  <td><div id='timeIn16'>  </div> </td> <td> <div id='timeOut16'>  </div></td> <td><div id='remarks16'>  </div> </td>     </tr>
								<tr> <td> 17th</td> <td> <div id='available17'>  </div> </td>  <td><div id='timeIn17'>  </div> </td> <td> <div id='timeOut17'>  </div></td> <td><div id='remarks17'>  </div> </td>     </tr>
								<tr> <td> 18th</td> <td> <div id='available18'>  </div> </td>  <td><div id='timeIn18'>  </div> </td> <td> <div id='timeOut18'>  </div></td> <td><div id='remarks18'>  </div> </td>     </tr>
								<tr> <td> 19th</td> <td> <div id='available19'>  </div> </td>  <td><div id='timeIn19'>  </div> </td> <td> <div id='timeOut19'>  </div></td> <td><div id='remarks19'>  </div> </td>     </tr>
								<tr> <td> 20th</td> <td> <div id='available20'>  </div> </td>  <td><div id='timeIn20'>  </div> </td> <td> <div id='timeOut20'>  </div></td> <td><div id='remarks20'>  </div> </td>     </tr>
								<tr> <td> 21st</td> <td> <div id='available21'>  </div> </td>  <td><div id='timeIn21'>  </div> </td> <td> <div id='timeOut21'>  </div></td> <td><div id='remarks21'>  </div> </td>     </tr>
								<tr> <td> 22nd</td> <td> <div id='available22'>  </div> </td>  <td><div id='timeIn22'>  </div> </td> <td> <div id='timeOut22'>  </div></td> <td><div id='remarks22'>  </div> </td>     </tr>
								<tr> <td> 23rd</td> <td> <div id='available23'>  </div> </td>  <td><div id='timeIn23'>  </div> </td> <td> <div id='timeOut23'>  </div></td> <td><div id='remarks23'>  </div> </td>     </tr>
								<tr> <td> 24th</td> <td> <div id='available24'>  </div> </td>  <td><div id='timeIn24'>  </div> </td> <td> <div id='timeOut24'>  </div></td> <td><div id='remarks24'>  </div> </td>     </tr>
								<tr> <td> 25th</td> <td> <div id='available25'>  </div> </td>  <td><div id='timeIn25'>  </div> </td> <td> <div id='timeOut25'>  </div></td> <td><div id='remarks25'>  </div> </td>     </tr>
								<tr> <td> 26th</td> <td> <div id='available26'>  </div> </td>  <td><div id='timeIn26'>  </div> </td> <td> <div id='timeOut26'>  </div></td> <td><div id='remarks26'>  </div> </td>     </tr>
								<tr> <td> 27th</td> <td> <div id='available27'>  </div> </td>  <td><div id='timeIn27'>  </div> </td> <td> <div id='timeOut27'>  </div></td> <td><div id='remarks27'>  </div> </td>     </tr>
								<tr> <td> 28th</td> <td> <div id='available28'>  </div> </td>  <td><div id='timeIn28'>  </div> </td> <td> <div id='timeOut28'>  </div></td> <td><div id='remarks28'>  </div> </td>     </tr>
								<tr> <td> 29th</td> <td> <div id='available29'>  </div> </td>  <td><div id='timeIn29'>  </div> </td> <td> <div id='timeOut29'>  </div></td> <td><div id='remarks29'>  </div> </td>     </tr>
								<tr> <td> 30th</td> <td> <div id='available30'>  </div> </td>  <td><div id='timeIn30'>  </div> </td> <td> <div id='timeOut30'>  </div></td> <td><div id='remarks30'>  </div> </td>     </tr>
								<tr> <td> 31st</td> <td> <div id='available31'>  </div> </td>  <td><div id='timeIn31'>  </div> </td> <td> <div id='timeOut31'>  </div></td> <td><div id='remarks31'>  </div> </td>     </tr>
								
							
							
							";
							
							
				        	echo "</div>";
				        	echo "</table>";
						
						//	echo "<div id='available1'>  </div>";
							
						
						
						echo "</div>";
						
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