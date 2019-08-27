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
	 <script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js') ?>"></script> 
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
    <script src="<?php echo base_url('assets/highcharts/js/highcharts.js') ?>"></script> 
    <script src="<?php echo base_url('assets/highcharts/js/modules/exporting.js') ?>"></script> 
   
<script>
	$(document).ready(function(){		
		$(".hidechart").hide();
		$(".compare").click(function(e){
			event.preventDefault();
			var i = $(this).val();
			var sections = i.split('.');
			var amount = parseFloat(sections[0]);
			var balance = parseFloat(sections[1]);
				
		//var data[] = array('name' => 'Brands', 'colorByPoint' => true,  'data'=> array(['name' => 'Balance', 'y' => 50],['name'=> 'Amount Requested', 'y'=>20 ],
		//));
		seriesdata = ([{						
		 name: "PERCENTAGE", 
                colorByPoint: true,
                data: [{
                    name: "Balance",
                    y: balance
                }, {
                    name: "Requested Amount",
                    y: amount,
                    sliced: false,
                    selected: true
                }]
            }])
				
					$('#container').show('slide');
					$(".hidechart").show('slide');
				$('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: true,
                plotShadow: true,
                type: 'pie'
            },
            title: { 
                text: 'COMPARISION: BALANCE Vs REQUESTED AMOUNT'
            }, 
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true  
                }
            },
            credits: {
                	enabled: false
               },
            series: seriesdata

			
		});
				
		});
		
		$(".approve").click(function(e){
			event.preventDefault();
			$(this).hide();
			var i = $(this).val();
			var sections = i.split('.');
			var impNumber = sections[0];
			var amount = parseFloat(sections[1]);			
			var account_number = sections[2];
			
			$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>" + "index.php/fms/financialImprestApproved",
					dataType: "json",
					data: {
						impNumber: impNumber, account_number: account_number, amount: amount,
					},
					success: function(response){
						if(response){
							alert('Imprest Request Approved Successfully!');
						}
					}
				
			});
		});
		
		$(".reject").click(function(e){
			event.preventDefault();
			var impNumber = $(this).val();
			
			$.ajax({
					type: "post",
					url: "<?php echo base_url(); ?>" + "index.php/fms/financialImprestRejected", 
					dataType: 'json',
					data: {
							impNumber: impNumber,
					},
					success: function(response){
						if(response){
							alert("Imprest Request Rejected Successfully!");
						}
					}
			});
		});
		
		$("#refresh").click(function(e){
			event.preventDefault();
			location.reload(true);
		});
		
		$(".hidechart").click(function(){
			$('#container').slideUp();
			$(".hidechart").slideUp();
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
			    		<h3 class="panel-title" align="center"> :::: FINANCIAL IMPREST REQUESTS :::</h3>  
			  		</div>
			  		<div class="panel-body"> 
			  			
			  		<center> <div id="refresh"> <abbr title="Click to refresh "> 	<i class="fa fa-refresh fa-3x"></i> </abbr></div></center>
			  			<fieldset>  
			  			<?php echo validation_errors(); ?>
				
				        <?php $attributes = array('class' => 'form-horizontal row-border', 'id' => 'profile');?>	
						<?php echo form_open('', $attributes); 
					
						//echo "<div id='result' style='display: none'>";					
						echo "<div class='col-xl-6'>";	?>
			  			<div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-hover ">
						<?php
						
						echo "<h3> Approve/Reject Imprest Request </h3><hr>";
						echo " <span class='hidechart fa fa-close fa-2x pull-right'></span>  ";
						echo "<div id='container' style='min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto; display: none;'> </div>";
						echo "<thead>
				        		<tr> 
						        	<th><center>Request Number </center></th>
						        	<th><center>Raised By </center></th>
						        	<th><center>Amount </center></th>
						        	<th><center>Raised For </center></th>
						        	<th><center>Date Raised</center></th>
						        	<th><center>Purpose</center></th>
						        	<th><center>Debit Acc</center></th>
						        	<th><center>Supervisors' Approval</center></th>
						        	<th><center>Visualize</center></th>
						        	<th><center>Actions(Approve/Reject)</center></th>
						        	
				        		</tr></thead>";
							foreach($approvals as $row){  
								if($row){
                        		echo" 				        	
				        	
				        	<tr> <td>{$row->impNumber}</td> <td> {$row->FName} {$row->LName}</td>  <td>  {$row->amount} </td>   <td> {$row->payee_account} </td>  <td>{$row->date_raised} </td> <td> {$row->purpose} </td>  <td> <center> {$row->account_number} </center> </td>  <td> {$row->supervisor_approval} </td> <td> <button class='compare btn btn-sm $buttonclass' value='{$row->amount}.{$row->account_balance}'>Compare </button> </td>  <td><center>"; if($row->supervisor_approval==="Approved"){echo " <button class='approve btn btn-sm  $buttonclass'   value='{$row->impNumber}.{$row->amount}.{$row->account_number}'>Approve</button>  <button class='reject btn btn-sm  btn-warning'   value='$row->impNumber'>Reject</button>";} echo " </center>  </td>	 </tr>
				        	";}else{
				        		echo "No approvals yet. Check back later!<br> ";
								break;
				        	}} echo "
						</table></div>"; 
						
						
					
						
						?>	
			  			</div> 
					</div> <!--End of PB -->
				
		       </div>
			   <?php echo br(5); ?>
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