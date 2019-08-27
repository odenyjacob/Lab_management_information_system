
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> <?php echo $title; ?> </title>
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

    <!-- Metis Menu Plugin JavaScript -->
   <script src="<?php echo base_url('dashboard/js/plugins/metisMenu/metisMenu.min.js') ?>"></script>
   <link href="<?php echo base_url('dashboard/css/home.css') ?>" rel="stylesheet">

    <!-- Custom Theme JavaScript -->
   <script src="<?php echo base_url('dashboard/js/sb-admin-2.js') ?>"></script>
   <link href=<?php echo base_url('assets/css/font-awesome.css') ?> rel="stylesheet">   
    <script src="<?php echo base_url('assets/highcharts/js/highcharts.js') ?>"></script> 
    <script src="<?php echo base_url('assets/highcharts/js/modules/exporting.js') ?>"></script> 
   <style>
.zoom{
	transition: all .2s ease-in-out;
}
.zoom:hover{
	text-decoration:overline;
	text-transform: uppercase;
	color: red;
}

.bodyzoom{
	transition: all .2s ease-in-out; 
}

.bodyzoom:hover{
	text-decoration:overline;
	text-transform: uppercase;
	//text-shadow: 4px 5px #ccc;
	color: red;
}


</style>
   
    <script>
    

    $(document).ready(function () {

    });
    
    $(function () {
    $('#container').highcharts({
        title: {
            text: "  SAMPLE REJECTION MONITORING"
        },
        xAxis: {
            categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEPT', 'OCT', 'NOV', 'DEC']
        },
        series: [{
            type: 'column',
            name: '% Rejection',
            data: [<?php echo $rJAN.",". $rFEB.",". $rMAR .",". $rAPR .",". $rMAY .",". $rJUN .",". $rJUL .",". $rAUG .",". $rSEP .",". $rOCT .",". $rNOV .",". $rDEC ;?>]
        }, {
            type: 'column',
            name: '% Target',
            data: [<?php echo $tJAN.",". $tFEB.",". $tMAR .",". $tAPR .",". $tMAY .",". $tJUN .",". $tJUL .",". $tAUG .",". $tSEP .",". $tOCT .",". $tNOV .",". $tDEC ;?>]
        },  {
            type: 'spline',
            name: 'Average',
            data: [<?php echo ($tJAN+$rJAN)/2 .",". ($tFEB+ $rFEB)/2 .",". ($tMAR+$rMAR)/2 .",". ($tAPR+$rAPR)/2 .",". ($tMAY+$rMAY)/2 .",". ($tJUN+$rJUN)/2 .",".
            		 ($tJUL+$rJUL)/2 .",". ($tAUG+$rAUG)/2 .",". ($tSEP+$rSEP)/2 .",". ($tOCT+$rOCT)/2 .",". ($tNOV+$rNOV)/2 .",". ($tDEC+$rDEC)/2 ;?>],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        },{
            type: 'spline',
            name: 'Target',
            data: [<?php echo $tJAN.",". $tFEB.",". $tMAR .",". $tAPR .",". $tMAY .",". $tJUN .",". $tJUL .",". $tAUG .",". $tSEP .",". $tOCT .",". $tNOV .",". $tDEC ;?>],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[5],
                fillColor: 'white'
            }
        },{
            type: 'spline',
            name: 'Rejection',
            data: [<?php echo $rJAN.",". $rFEB.",". $rMAR .",". $rAPR .",". $rMAY .",". $rJUN .",". $rJUL .",". $rAUG .",". $rSEP .",". $rOCT .",". $rNOV .",". $rDEC ;?>],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[4],
                fillColor: 'white'
            }
        }],
        credits: {
          enabled: false
        },
    });
});

    
		  $(function() {
		    $( "#accordion" ).accordion();
		  });
  
  </script>

      
     
</head>
<body >
	<div id="">	
		<div class="row">
			<div class="col-md-12 col-md-offset-0">		

				<div class="<?php echo $this->session->userdata('panel'); ?>">
			  		<div class="panel-heading">
			    		<h3 class="panel-title" align="center"><i class="zoom fa fa-pie-chart"></i> &nbsp <i class="zoom fa fa-line-chart"></i> </i> <i class="zoom fa fa-bar-chart"></i> </i> :::: GRAPHICS AND SUMMARIES FOR THE YEAR <?php echo $year; ?> :::</h3>  
			  		</div>
			  		<div class="panel-body"> 
			  	
						
						
					</div> <!-- PPB -->
				
							
						<div id="accordion">
							  <h3>SAMPLE REJECTION CHART (<?php echo $year; ?>) </h3>
							<div>
								<div id="container" style=""  > </div>
								<!-- style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto" -->
							</div>
							<h3>CONCEPTS</h3>
							<div>
							<h4><b> Objective</b></h4>
								<?php echo $concepts['objective']; ?>
							<hr />	<h4><b> Measure</b></h4>
								<?php echo $concepts['measure']; ?>
							<hr />	<h4><b> Reporting Schedule</b></h4>
								<?php echo $concepts['reporting_schedule']; ?>
							<hr />	<h4><b> Methodology</b></h4>							
								<?php echo nbs(5). "<i> <u>". $concepts['methodology_numerator']."</u>".nbs(2); if(!empty($concepts['methodology_multiplier'])){ echo "x".' ';} echo  $concepts['methodology_multiplier'].br().nbs(5). $concepts['methodology_denominator']. "</i>"; ?>
							</div>		
							
							<h3>ANALYSIS (<?php echo $year; ?>)</h3>
							<div>
								<?php echo $summaries['analysis']; ?>
							</div>		
								
							<h3>INTERPRETATION (<?php echo $year; ?>)</h3>
							<div>
								<?php echo $summaries['interpretation']; ?>
								
							</div>	
							
							<h3>LIMITATIONS (<?php echo $year; ?>)</h3>
							<div>
								<?php echo $summaries['limitation']; ?> 
								
							</div>	
							
							<h3>ACTION PLAN (<?php echo $year; ?>)</h3>
							<div>
								<?php echo $summaries['action_plan']; ?>  
								
							</div>	
											  
						</div>				
				</div> <!-- PPR -->	
				
									
						   
						   
									<div class="<?php echo $this->session->userdata('panel'); ?>">
							<div>												
								<h6 align="center"> &copy <?php echo date("Y") . " All Rights Reserved" ;?>
								<?php echo br(2); echo $this->session->userdata('creditline'); ?>	</h6> 
								</div>  
							</div>		   
		    </div> <!-- OS -->
		</div> <!-- CR -->
	</div> <!-- PW -->
</body>	

</html>