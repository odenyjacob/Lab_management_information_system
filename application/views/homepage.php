
<style>
@-webkit-keyframes spaceboots{
    0% {-webkit-transform: translate(2px, 1px) rotate(0deg); }
    10%{-webkit-transform: translate(-1px, -2px) rotate(-1deg); }
    20%{-webkit-transform: translate(-3px, 0px) rotate(1deg); }
    30%{-webkit-transform: translate(0px, 2px) rotate(0deg); }
    40%{-webkit-transform: translate(1px, -1px) rotate(1deg); }
    50%{-webkit-transform: translate(-1px, 2px) rotate(-1deg); }
    60%{-webkit-transform: translate(-3px, 1px) rotate(0deg); }  
    70%{-webkit-transform: translate(2px, 1px) rotate(-1deg); }
    80%{-webkit-transform: translate(-1px, -1px) rotate(1deg); }
    90%{-webkit-transform: translate(2px, 2px) rotate(0deg); }
   100%{-webkit-transform: translate(1px, -2px) rotate(-1deg); }
   
   
   0% {-moz-transform: translate(2px, 1px) rotate(0deg); } 
    10%{-moz-transform: translate(-1px, -2px) rotate(-1deg); }
    20%{-moz-transform: translate(-3px, 0px) rotate(1deg); }
    30%{-moz-transform: translate(0px, 2px) rotate(0deg); }
    40%{-moz-transform: translate(1px, -1px) rotate(1deg); }
    50%{-moz-transform: translate(-1px, 2px) rotate(-1deg); }
    60%{-moz-transform: translate(-3px, 1px) rotate(0deg); }
    70%{-moz-transform: translate(2px, 1px) rotate(-1deg); }
    80%{-moz-transform: translate(-1px, -1px) rotate(1deg); }
    90%{-moz-transform: translate(2px, 2px) rotate(0deg); }
   100%{-moz-transform: translate(1px, -2px) rotate(-1deg); }
}
.shake:hover,
.shake:focus{
    -webkit-animation-name: spaceboots;
    -webkit-animation-duration: 0.8s;
    -webkit-transform-origin: 50% 50%;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    
    -moz-animation-name: spaceboots;
    -moz-animation-duration: 0.8s;
    -moz-transform-origin: 50% 50%;
    -moz-animation-iteration-count: infinite;
    -moz-animation-timing-function: linear;
}
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
   
   
    <script>
    

    $(document).ready(function () {

        // Build the chart
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'scatter',
            margin: [70, 50, 60, 80],
            events: {
                click: function (e) {
                    // find the clicked values and the series
                    var x = e.xAxis[0].value,
                        y = e.yAxis[0].value,
                        series = this.series[0];

                    // Add it
                    series.addPoint([x, y]);

                }
            }
        },
        title: {
            text: 'Digital Play Area, User Supplied Data'
        },
        subtitle: {
            text: 'Click the plot area to add a point. Click a point to remove it.'
        },
        xAxis: {
            gridLineWidth: 1,
            minPadding: 0.2,
            maxPadding: 0.2,
            maxZoom: 60
        },
        yAxis: {
            title: {
                text: 'Value'
            },
            minPadding: 0.2,
            maxPadding: 0.2,
            maxZoom: 60,
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        legend: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        plotOptions: {
            series: {
                lineWidth: 2,
                point: {
                    events: {
                        'click': function () {
                            if (this.series.data.length > 1) {
                                this.remove();
                            }
                        }
                    }
                }
            }
        },
        series: [{
            data: [[20, 20], [80, 80]]
        }],
		credits: {
          enabled: false
        },
    });
});
    });
    
  
    
		  $(function() {
		    $( "#accordion" ).accordion();
		  });
		  
  </script>

      
     
</head>
<body >
	<div id="page-wrapper">	
		<div class="row">
			<div class="col-md-12 col-md-offset-0">		

				<div class="<?php echo $this->session->userdata('panel'); ?>">
			  		<div class="panel-heading">
			    		<h3 class="panel-title" align="center"><i class="zoom fa fa-pie-chart"></i> &nbsp <i class="zoom fa fa-line-chart"></i> </i> <i class="zoom fa fa-bar-chart"></i> </i> :::: GRAPHICAL PLAY GROUND :::</h3>  
			  		</div>
			  		<div class="panel-body"> 
			  		
						
					</div> <!-- PPB -->
				
							
						<div id="accordion">
							  <h3>Play Ground : Plot your chart here, We won't store it!</h3>
							<div><p>
								
								
								</p>
								<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"> </div>
							</div>
							  <h3>Upcoming events</h3>
							<div>
								
								<p>
								
								</p>
							</div>
							  
							  <br />
					<!--		  
				<div id="dialog" title="Development Information">
			  			<p>This ERP is currently under development. Check back soon!</p> 
			  			
				</div> -->
				
				
			
							  
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