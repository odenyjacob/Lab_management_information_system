<?php
	if($access['timecard']!='yes'){
		redirect('main/unauthorized');
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
	<?php $tClass = $this->session->userdata('tClass');?> 
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
		$("#update").hide();
		$("input").prop('disabled', true);
		$("select").prop('disabled', true);
		$("#submit").removeAttr('disabled');
		$("#edit").removeAttr('disabled');
		
		$('#submit').click(function(event){
				event.preventDefault();
				var available1 = $("#available1").val();	var available2 = $("#available2").val(); var available3 = $("#available3").val();
				var available4 = $("#available4").val(); var available5 = $("#available5").val(); var available6 = $("#available6").val();
				var available7 = $("#available7").val(); var available8 = $("#available8").val(); var available9 = $("#available9").val();
				var available10 = $("#available10").val(); var available11 = $("#available11").val(); var available12 = $("#available12").val();
				var available13 = $("#available13").val(); var available14 = $("#available14").val(); var available15 = $("#available15").val();
				var available16 = $("#available16").val(); var available17 = $("#available17").val(); var available18 = $("#available18").val();
				var available19 = $("#available19").val(); var available20 = $("#available20").val(); var available21 = $("#available21").val();
				var available22 = $("#available22").val(); var available23 = $("#available23").val(); var available24 = $("#available24").val();
				var available25 = $("#available25").val(); var available26 = $("#available26").val(); var available27 = $("#available27").val();
				var available28 = $("#available28").val(); var available29 = $("#available29").val(); var available30 = $("#available30").val();
				var available31 = $("#available31").val();
				
				
				var timeIn1 = $("#timeIn1").val(); var timeIn2 = $("#timeIn2").val(); var timeIn3 = $("#timeIn3").val();
				var timeIn4 = $("#timeIn4").val(); var timeIn5 = $("#timeIn5").val(); var timeIn6 = $("#timeIn6").val();
				var timeIn7 = $("#timeIn7").val(); var timeIn8 = $("#timeIn8").val(); var timeIn9 = $("#timeIn9").val();
				var timeIn10 = $("#timeIn10").val(); var timeIn11 = $("#timeIn11").val(); var timeIn12 = $("#timeIn12").val();
				var timeIn13 = $("#timeIn13").val(); var timeIn14 = $("#timeIn14").val(); var timeIn15 = $("#timeIn15").val();
				var timeIn16 = $("#timeIn16").val(); var timeIn17 = $("#timeIn17").val(); var timeIn18 = $("#timeIn18").val();
				var timeIn19 = $("#timeIn19").val(); var timeIn20 = $("#timeIn20").val(); var timeIn21 = $("#timeIn21").val();
				var timeIn22 = $("#timeIn22").val(); var timeIn23 = $("#timeIn23").val(); var timeIn24 = $("#timeIn24").val();
				var timeIn25 = $("#timeIn25").val(); var timeIn26 = $("#timeIn26").val(); var timeIn27 = $("#timeIn27").val();
				var timeIn28 = $("#timeIn28").val(); var timeIn29 = $("#timeIn29").val(); var timeIn30 = $("#timeIn30").val();
				var timeIn31 = $("#timeIn31").val();
				
				
				var timeOut1 = $("#timeOut1").val(); var timeOut2 = $("#timeOut2").val(); var timeOut3 = $("#timeOut3").val();
				var timeOut4 = $("#timeOut4").val(); var timeOut5 = $("#timeOut5").val(); var timeOut6 = $("#timeOut6").val();
				var timeOut7 = $("#timeOut7").val(); var timeOut8 = $("#timeOut8").val(); var timeOut9 = $("#timeOut9").val();
				var timeOut10 = $("#timeOut10").val(); var timeOut11 = $("#timeOut11").val(); var timeOut12 = $("#timeOut12").val();
				var timeOut13 = $("#timeOut13").val(); var timeOut14 = $("#timeOut14").val(); var timeOut15 = $("#timeOut15").val();
				var timeOut16 = $("#timeOut16").val(); var timeOut17 = $("#timeOut17").val(); var timeOut18 = $("#timeOut18").val();
				var timeOut19 = $("#timeOut19").val(); var timeOut20 = $("#timeOut20").val(); var timeOut21 = $("#timeOut21").val();
				var timeOut22 = $("#timeOut22").val(); var timeOut23 = $("#timeOut23").val(); var timeOut24 = $("#timeOut24").val();
				var timeOut25 = $("#timeOut25").val(); var timeOut26 = $("#timeOut26").val(); var timeOut27 = $("#timeOut27").val();
				var timeOut28 = $("#timeOut28").val(); var timeOut29 = $("#timeOut29").val(); var timeOut30 = $("#timeOut30").val();
				var timeOut31 = $("#timeOut31").val();
				
				
				var remarks1 = $("#remarks1").val(); var remarks2 = $("#remarks2").val(); var remarks3 = $("#remarks3").val();
				var remarks4 = $("#remarks4").val(); var remarks5 = $("#remarks5").val(); var remarks6 = $("#remarks6").val();
				var remarks7 = $("#remarks7").val(); var remarks8 = $("#remarks8").val(); var remarks9 = $("#remarks9").val();
				var remarks10 = $("#remarks10").val(); var remarks11 = $("#remarks11").val(); var remarks12 = $("#remarks12").val();
				var remarks13 = $("#remarks13").val(); var remarks14 = $("#remarks14").val(); var remarks15 = $("#remarks15").val();
				var remarks16 = $("#remarks16").val(); var remarks17 = $("#remarks17").val(); var remarks18 = $("#remarks18").val();
				var remarks19 = $("#remarks19").val(); var remarks20 = $("#remarks20").val(); var remarks21 = $("#remarks21").val();
				var remarks22 = $("#remarks22").val(); var remarks23 = $("#remarks23").val(); var remarks24 = $("#remarks24").val();
				var remarks25 = $("#remarks25").val(); var remarks26 = $("#remarks26").val(); var remarks27 = $("#remarks27").val();
				var remarks28 = $("#remarks28").val(); var remarks29 = $("#remarks29").val(); var remarks30 = $("#remarks30").val();
				var remarks31 = $("#remarks31").val();
				
				$.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/hcm/pEditedTc",
				dataType: 'json',
				data: {
					available1: available1, available2: available2, available3: available3, available4: available4,
					available5: available5, available6: available6, available7: available7, available8: available8,
					available9: available9, available10: available10, available11: available11, available12: available12,
					available13: available13, available14: available14, available15: available15, available16: available16,
					available17: available17, available18: available18, available19: available19, available20: available20,
					available21: available21, available22: available22, available23: available23, available24: available24,
					available25: available25, available26: available26, available27: available27, available28: available28,
					available29: available29, available30: available30, available31: available31,
					
					timeIn1:timeIn1, timeIn2:timeIn2, timeIn3:timeIn3, timeIn4:timeIn4,
					timeIn5:timeIn5, timeIn6:timeIn6, timeIn7:timeIn7, timeIn8:timeIn8,
					timeIn9:timeIn9, timeIn10:timeIn10, timeIn11:timeIn11, timeIn12:timeIn12,
					timeIn13:timeIn13, timeIn14:timeIn14, timeIn15:timeIn15, timeIn16:timeIn16,
					timeIn17:timeIn17, timeIn18:timeIn18, timeIn19:timeIn19, timeIn20:timeIn20,
					timeIn21:timeIn21, timeIn22:timeIn22, timeIn23:timeIn23, timeIn24:timeIn24,
					timeIn25:timeIn25, timeIn26:timeIn26, timeIn27:timeIn27, timeIn28:timeIn28,
					timeIn29:timeIn29, timeIn30:timeIn30, timeIn31:timeIn31,
					
					timeOut1: timeOut1, timeOut2: timeOut2, timeOut3: timeOut3, timeOut4: timeOut4,
					timeOut5: timeOut5, timeOut6: timeOut6, timeOut7: timeOut7, timeOut8: timeOut8,
					timeOut9: timeOut9, timeOut10: timeOut10, timeOut11: timeOut11, timeOut12: timeOut12,
					timeOut13: timeOut13, timeOut14: timeOut14, timeOut15: timeOut15, timeOut16: timeOut16,
					timeOut17: timeOut17, timeOut18: timeOut18, timeOut19: timeOut19, timeOut20: timeOut20,
					timeOut21: timeOut21, timeOut22: timeOut22, timeOut23: timeOut23, timeOut24: timeOut24,
					timeOut25: timeOut25, timeOut26: timeOut26, timeOut27: timeOut27, timeOut28: timeOut28,
					timeOut29: timeOut29, timeOut30: timeOut30, timeOut31: timeOut31,
					
					remarks1: remarks1, remarks2: remarks2, remarks3: remarks3, remarks4: remarks4,
					remarks5: remarks5, remarks6: remarks6, remarks7: remarks7, remarks8: remarks8,
					remarks9: remarks9, remarks10: remarks10, remarks11: remarks11, remarks12: remarks12,
					remarks13: remarks13, remarks14: remarks14, remarks15: remarks15, remarks16: remarks16,					
					remarks17: remarks17, remarks18: remarks18, remarks19: remarks19, remarks20: remarks20, 
					remarks21: remarks21, remarks22: remarks22, remarks23: remarks23, remarks24: remarks24, 
					remarks25: remarks25, remarks26: remarks26, remarks27: remarks27, remarks28: remarks28, 
					remarks29: remarks29, remarks30: remarks30, remarks31: remarks31, 
				},
			success: function(response){
				if(response){
					
					$("#update").hide();
					$("#edit").hide('slide');
					$("#submit").hide('slide');
					$("select").prop('disabled', true);
					$("input").prop('disabled', true);
					
					alert('Time-card Submitted successfully!');
				}else{
					alert('Something went wrong... Try again!');
				}
			}
			});
				
				
			
		});
		
		$("#edit").click(function(event){
			event.preventDefault();
			$("#edit").hide();
			$("#update").show("down");
			$("#update").prop("disabled", false);
			$("input").prop('disabled', false);
			$("select").prop('disabled', false);
			
			
		});
		
		$("#update").click(function(event){
			event.preventDefault();			
			var available1 = $("#available1").val();	var available2 = $("#available2").val(); var available3 = $("#available3").val();
				var available4 = $("#available4").val(); var available5 = $("#available5").val(); var available6 = $("#available6").val();
				var available7 = $("#available7").val(); var available8 = $("#available8").val(); var available9 = $("#available9").val();
				var available10 = $("#available10").val(); var available11 = $("#available11").val(); var available12 = $("#available12").val();
				var available13 = $("#available13").val(); var available14 = $("#available14").val(); var available15 = $("#available15").val();
				var available16 = $("#available16").val(); var available17 = $("#available17").val(); var available18 = $("#available18").val();
				var available19 = $("#available19").val(); var available20 = $("#available20").val(); var available21 = $("#available21").val();
				var available22 = $("#available22").val(); var available23 = $("#available23").val(); var available24 = $("#available24").val();
				var available25 = $("#available25").val(); var available26 = $("#available26").val(); var available27 = $("#available27").val();
				var available28 = $("#available28").val(); var available29 = $("#available29").val(); var available30 = $("#available30").val();
				var available31 = $("#available31").val();
				
				
				var timeIn1 = $("#timeIn1").val(); var timeIn2 = $("#timeIn2").val(); var timeIn3 = $("#timeIn3").val();
				var timeIn4 = $("#timeIn4").val(); var timeIn5 = $("#timeIn5").val(); var timeIn6 = $("#timeIn6").val();
				var timeIn7 = $("#timeIn7").val(); var timeIn8 = $("#timeIn8").val(); var timeIn9 = $("#timeIn9").val();
				var timeIn10 = $("#timeIn10").val(); var timeIn11 = $("#timeIn11").val(); var timeIn12 = $("#timeIn12").val();
				var timeIn13 = $("#timeIn13").val(); var timeIn14 = $("#timeIn14").val(); var timeIn15 = $("#timeIn15").val();
				var timeIn16 = $("#timeIn16").val(); var timeIn17 = $("#timeIn17").val(); var timeIn18 = $("#timeIn18").val();
				var timeIn19 = $("#timeIn19").val(); var timeIn20 = $("#timeIn20").val(); var timeIn21 = $("#timeIn21").val();
				var timeIn22 = $("#timeIn22").val(); var timeIn23 = $("#timeIn23").val(); var timeIn24 = $("#timeIn24").val();
				var timeIn25 = $("#timeIn25").val(); var timeIn26 = $("#timeIn26").val(); var timeIn27 = $("#timeIn27").val();
				var timeIn28 = $("#timeIn28").val(); var timeIn29 = $("#timeIn29").val(); var timeIn30 = $("#timeIn30").val();
				var timeIn31 = $("#timeIn31").val();
				
				
				var timeOut1 = $("#timeOut1").val(); var timeOut2 = $("#timeOut2").val(); var timeOut3 = $("#timeOut3").val();
				var timeOut4 = $("#timeOut4").val(); var timeOut5 = $("#timeOut5").val(); var timeOut6 = $("#timeOut6").val();
				var timeOut7 = $("#timeOut7").val(); var timeOut8 = $("#timeOut8").val(); var timeOut9 = $("#timeOut9").val();
				var timeOut10 = $("#timeOut10").val(); var timeOut11 = $("#timeOut11").val(); var timeOut12 = $("#timeOut12").val();
				var timeOut13 = $("#timeOut13").val(); var timeOut14 = $("#timeOut14").val(); var timeOut15 = $("#timeOut15").val();
				var timeOut16 = $("#timeOut16").val(); var timeOut17 = $("#timeOut17").val(); var timeOut18 = $("#timeOut18").val();
				var timeOut19 = $("#timeOut19").val(); var timeOut20 = $("#timeOut20").val(); var timeOut21 = $("#timeOut21").val();
				var timeOut22 = $("#timeOut22").val(); var timeOut23 = $("#timeOut23").val(); var timeOut24 = $("#timeOut24").val();
				var timeOut25 = $("#timeOut25").val(); var timeOut26 = $("#timeOut26").val(); var timeOut27 = $("#timeOut27").val();
				var timeOut28 = $("#timeOut28").val(); var timeOut29 = $("#timeOut29").val(); var timeOut30 = $("#timeOut30").val();
				var timeOut31 = $("#timeOut31").val();
				
				
				var remarks1 = $("#remarks1").val(); var remarks2 = $("#remarks2").val(); var remarks3 = $("#remarks3").val();
				var remarks4 = $("#remarks4").val(); var remarks5 = $("#remarks5").val(); var remarks6 = $("#remarks6").val();
				var remarks7 = $("#remarks7").val(); var remarks8 = $("#remarks8").val(); var remarks9 = $("#remarks9").val();
				var remarks10 = $("#remarks10").val(); var remarks11 = $("#remarks11").val(); var remarks12 = $("#remarks12").val();
				var remarks13 = $("#remarks13").val(); var remarks14 = $("#remarks14").val(); var remarks15 = $("#remarks15").val();
				var remarks16 = $("#remarks16").val(); var remarks17 = $("#remarks17").val(); var remarks18 = $("#remarks18").val();
				var remarks19 = $("#remarks19").val(); var remarks20 = $("#remarks20").val(); var remarks21 = $("#remarks21").val();
				var remarks22 = $("#remarks22").val(); var remarks23 = $("#remarks23").val(); var remarks24 = $("#remarks24").val();
				var remarks25 = $("#remarks25").val(); var remarks26 = $("#remarks26").val(); var remarks27 = $("#remarks27").val();
				var remarks28 = $("#remarks28").val(); var remarks29 = $("#remarks29").val(); var remarks30 = $("#remarks30").val();
				var remarks31 = $("#remarks31").val();
				
				$.ajax({
				type: "POST",	
				url: "<?php echo base_url(); ?>" + "index.php/hcm/saveTc",
				dataType: 'json',
				data: {
					available1: available1, available2: available2, available3: available3, available4: available4,
					available5: available5, available6: available6, available7: available7, available8: available8,
					available9: available9, available10: available10, available11: available11, available12: available12,
					available13: available13, available14: available14, available15: available15, available16: available16,
					available17: available17, available18: available18, available19: available19, available20: available20,
					available21: available21, available22: available22, available23: available23, available24: available24,
					available25: available25, available26: available26, available27: available27, available28: available28,
					available29: available29, available30: available30, available31: available31,
					
					timeIn1:timeIn1, timeIn2:timeIn2, timeIn3:timeIn3, timeIn4:timeIn4,
					timeIn5:timeIn5, timeIn6:timeIn6, timeIn7:timeIn7, timeIn8:timeIn8,
					timeIn9:timeIn9, timeIn10:timeIn10, timeIn11:timeIn11, timeIn12:timeIn12,
					timeIn13:timeIn13, timeIn14:timeIn14, timeIn15:timeIn15, timeIn16:timeIn16,
					timeIn17:timeIn17, timeIn18:timeIn18, timeIn19:timeIn19, timeIn20:timeIn20,
					timeIn21:timeIn21, timeIn22:timeIn22, timeIn23:timeIn23, timeIn24:timeIn24,
					timeIn25:timeIn25, timeIn26:timeIn26, timeIn27:timeIn27, timeIn28:timeIn28,
					timeIn29:timeIn29, timeIn30:timeIn30, timeIn31:timeIn31,
					
					timeOut1: timeOut1, timeOut2: timeOut2, timeOut3: timeOut3, timeOut4: timeOut4,
					timeOut5: timeOut5, timeOut6: timeOut6, timeOut7: timeOut7, timeOut8: timeOut8,
					timeOut9: timeOut9, timeOut10: timeOut10, timeOut11: timeOut11, timeOut12: timeOut12,
					timeOut13: timeOut13, timeOut14: timeOut14, timeOut15: timeOut15, timeOut16: timeOut16,
					timeOut17: timeOut17, timeOut18: timeOut18, timeOut19: timeOut19, timeOut20: timeOut20,
					timeOut21: timeOut21, timeOut22: timeOut22, timeOut23: timeOut23, timeOut24: timeOut24,
					timeOut25: timeOut25, timeOut26: timeOut26, timeOut27: timeOut27, timeOut28: timeOut28,
					timeOut29: timeOut29, timeOut30: timeOut30, timeOut31: timeOut31,
					
					remarks1: remarks1, remarks2: remarks2, remarks3: remarks3, remarks4: remarks4,
					remarks5: remarks5, remarks6: remarks6, remarks7: remarks7, remarks8: remarks8,
					remarks9: remarks9, remarks10: remarks10, remarks11: remarks11, remarks12: remarks12,
					remarks13: remarks13, remarks14: remarks14, remarks15: remarks15, remarks16: remarks16,					
					remarks17: remarks17, remarks18: remarks18, remarks19: remarks19, remarks20: remarks20, 
					remarks21: remarks21, remarks22: remarks22, remarks23: remarks23, remarks24: remarks24, 
					remarks25: remarks25, remarks26: remarks26, remarks27: remarks27, remarks28: remarks28, 
					remarks29: remarks29, remarks30: remarks30, remarks31: remarks31, 
				},
			success: function(response){
				if(response){					
					$("input").prop('disabled', true);
					$("select").prop('disabled', true);
					$("#update").hide();
					$("#edit").show("down");
					$("#edit").prop("disabled", false);
					$("#submit").prop("disabled", false);			
					
					alert('Time-card Saved successfully!');
				}else{
					alert('Something went wrong... Try again!');
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
			<div class="col-xs-12 col-xs-offset-0">				
				<div class="<?php echo $this->session->userdata('panel'); ?>">
			  		<div class="panel-heading">
			    		<h3 class="panel-title" align="center"> :::: TIME CARD : Status [<?php echo $timecard['status'];  ?>] :::</h3>  
			  		</div>			  		
			  		<div class="panel-body"> 
			  <?php 
			 
			  if($timecard['status'] == 'Pending Approval'){ 
			  	echo " <b> NB: </b> <i> You have submited this time-card, to continue editing, ask your supervisor to reject it! </i>";
		
			  }
			  
			  
			  			
			  			 echo form_open(); ?>
			  		<div class="box">
                        <div class="box-header">
                                    <h3 class="box-title">Time-card for January 2016</h3> 
                    	</div><!-- /.box-header -->
                    </div><!-- /.box-header -->
                    <?php echo "<div class='col-xl-6'>";	?>
			  			<div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-hover ">
                        	<?php
                        		echo "
				        	<thead>
				        		<tr class='<?php echo $tClass ?>'>
						        	<th > Date</th>
						        	<th>Availability</th>
						        	<th>Time In</th>
						        	<th>Time Out</th>
						        	<th>Remarks</th>
				        		</tr>
				        	</thead>";
							
							echo "							
				        	<tr class='<?php echo $tClass ?>'>  <td>1st </td> <td><select name='available1' id='available1' class='form-control'><option value='{$timecard['available1']}'>"; echo $timecard['available1']; echo " </option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn1' value='{$timecard['timeIn1']}' id='timeIn1' class='form-control' /> </td> <td> <input type='time' name='timeOut1' value='{$timecard['timeOut1']}' id='timeOut1' class='form-control' />  </td> <td> <input type='text' name='remarks1' value='{$timecard['remarks1']}' id='remarks1' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>2nd </td> <td><select name='available2' id='available2' class='form-control'><option value='{$timecard['available2']}'>"; echo $timecard['available2']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn2' value='{$timecard['timeIn2']}' id='timeIn2' class='form-control' /> </td> <td> <input type='time' name='timeOut2' value='{$timecard['timeOut2']}' id='timeOut2' class='form-control' />  </td> <td> <input type='text' name='remarks2' value='{$timecard['remarks2']}' id='remarks2' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>3rd </td> <td><select name='available3' id='available3' class='form-control'><option value='{$timecard['available3']}'>"; echo $timecard['available3']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn3' value='{$timecard['timeIn3']}' id='timeIn3' class='form-control' /> </td> <td> <input type='time' name='timeOut3' value='{$timecard['timeOut3']}' id='timeOut3' class='form-control' />  </td> <td> <input type='text' name='remarks3' value='{$timecard['remarks3']}' id='remarks3' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>4th </td> <td><select name='available4' id='available4' class='form-control'><option value='{$timecard['available4']}'>"; echo $timecard['available4']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn4' value='{$timecard['timeIn4']}' id='timeIn4' class='form-control' /> </td> <td> <input type='time' name='timeOut4' value='{$timecard['timeOut4']}' id='timeOut4' class='form-control' />  </td> <td> <input type='text' name='remarks4' value='{$timecard['remarks4']}' id='remarks4' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>5th </td> <td><select name='available5' id='available5' class='form-control'><option value='{$timecard['available5']}'>"; echo $timecard['available5']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn5' value='{$timecard['timeIn5']}' id='timeIn5' class='form-control' /> </td> <td> <input type='time' name='timeOut5' value='{$timecard['timeOut5']}' id='timeOut5' class='form-control' />  </td> <td> <input type='text' name='remarks5' value='{$timecard['remarks5']}' id='remarks5' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>6th </td> <td><select name='available6' id='available6' class='form-control'><option value='{$timecard['available6']}'>"; echo $timecard['available6']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn6' value='{$timecard['timeIn6']}' id='timeIn6' class='form-control' /> </td> <td> <input type='time' name='timeOut6' value='{$timecard['timeOut6']}' id='timeOut6' class='form-control' />  </td> <td> <input type='text' name='remarks6' value='{$timecard['remarks6']}' id='remarks6' class='form-control' />  </td> </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>7th </td> <td><select name='available7' id='available7' class='form-control'><option value='{$timecard['available7']}'>"; echo $timecard['available7']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn7' value='{$timecard['timeIn7']}' id='timeIn7' class='form-control' /> </td> <td> <input type='time' name='timeOut7' value='{$timecard['timeOut7']}' id='timeOut7' class='form-control' />  </td> <td> <input type='text' name='remarks7' value='{$timecard['remarks7']}' id='remarks7' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>8th </td> <td><select name='available8' id='available8' class='form-control'><option value='{$timecard['available8']}'>"; echo $timecard['available8']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn8' value='{$timecard['timeIn8']}' id='timeIn8' class='form-control' /> </td> <td> <input type='time' name='timeOut8' value='{$timecard['timeOut8']}' id='timeOut8' class='form-control' />  </td> <td> <input type='text' name='remarks8' value='{$timecard['remarks8']}' id='remarks8' class='form-control' />  </td> </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>9th </td> <td><select name='available9' id='available9' class='form-control'><option value='{$timecard['available9']}'>"; echo $timecard['available9']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn9' value='{$timecard['timeIn9']}' id='timeIn9' class='form-control' /> </td> <td> <input type='time' name='timeOut9' value='{$timecard['timeOut9']}' id='timeOut9' class='form-control' />  </td> <td> <input type='text' name='remarks9' value='{$timecard['remarks9']}' id='remarks9' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>10th </td> <td><select name='available10' id='available10' class='form-control'><option value='{$timecard['available10']}'>"; echo $timecard['available10']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn10' value='{$timecard['timeIn10']}' id='timeIn10' class='form-control' /> </td> <td> <input type='time' name='timeOut10' value='{$timecard['timeOut10']}' id='timeOut10' class='form-control' />  </td> <td> <input type='text' name='remarks10' value='{$timecard['remarks10']}' id='remarks10' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>11th </td> <td><select name='available11' id='available11' class='form-control'><option value='{$timecard['available11']}'>"; echo $timecard['available11']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn11' value='{$timecard['timeIn11']}' id='timeIn11' class='form-control' /> </td> <td> <input type='time' name='timeOut11' value='{$timecard['timeOut11']}' id='timeOut11' class='form-control' />  </td> <td> <input type='text' name='remarks11' value='{$timecard['remarks11']}' id='remarks11' class='form-control' />  </td> </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>12th </td> <td><select name='available12' id='available12' class='form-control'><option value='{$timecard['available12']}'>"; echo $timecard['available12']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn12' value='{$timecard['timeIn12']}' id='timeIn12' class='form-control' /> </td> <td> <input type='time' name='timeOut12' value='{$timecard['timeOut12']}' id='timeOut12' class='form-control' />  </td> <td> <input type='text' name='remarks12' value='{$timecard['remarks12']}' id='remarks12' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>13th </td> <td><select name='available13' id='available13' class='form-control'><option value='{$timecard['available13']}'>"; echo $timecard['available13']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn13' value='{$timecard['timeIn13']}' id='timeIn13' class='form-control' /> </td> <td> <input type='time' name='timeOut13' value='{$timecard['timeOut13']}' id='timeOut13' class='form-control' />  </td> <td> <input type='text' name='remarks13' value='{$timecard['remarks13']}' id='remarks13' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>14th </td> <td><select name='available14' id='available14' class='form-control'><option value='{$timecard['available14']}'>"; echo $timecard['available14']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn14' value='{$timecard['timeIn14']}' id='timeIn14' class='form-control' /> </td> <td> <input type='time' name='timeOut14' value='{$timecard['timeOut14']}' id='timeOut14' class='form-control' />  </td> <td> <input type='text' name='remarks14' value='{$timecard['remarks14']}' id='remarks14' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>15th </td> <td><select name='available15' id='available15' class='form-control'><option value='{$timecard['available15']}'>"; echo $timecard['available15']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn15' value='{$timecard['timeIn15']}' id='timeIn15' class='form-control' /> </td> <td> <input type='time' name='timeOut15' value='{$timecard['timeOut15']}' id='timeOut15' class='form-control' />  </td> <td> <input type='text' name='remarks15' value='{$timecard['remarks15']}' id='remarks15' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>16th </td> <td><select name='available16' id='available16' class='form-control'><option value='{$timecard['available16']}'>"; echo $timecard['available16']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn16' value='{$timecard['timeIn16']}' id='timeIn16' class='form-control' /> </td> <td> <input type='time' name='timeOut16' value='{$timecard['timeOut16']}' id='timeOut16' class='form-control' />  </td> <td> <input type='text' name='remarks16' value='{$timecard['remarks16']}' id='remarks16' class='form-control' />  </td>  </tr>
				        	
							"
                        	 ?> 
                        </table>
                       </div>
                      </div>
                      
                      <!--column 2 --> 
                    <?php echo "<div class='col-xl-6'>";	?>
			  			<div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-hover ">
                        	<?php
                        		echo "
				        	<thead>
				        		<tr class='<?php echo $tClass ?>'>
						        	<th > Date</th>
						        	<th>Availability</th>
						        	<th>Time In</th>
						        	<th>Time Out</th>
						        	<th>Remarks</th>
				        		</tr>
				        	</thead>";
							
							echo "							
				        	<tr class='<?php echo $tClass ?>'>  <td>17th </td> <td><select name='available17' id='available17' class='form-control'><option value='{$timecard['available17']}'>"; echo $timecard['available17']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn17' value='{$timecard['timeIn17']}' id='timeIn17' class='form-control' /> </td> <td> <input type='time' name='timeOut17' value='{$timecard['timeOut17']}' id='timeOut17' class='form-control' />  </td> <td> <input type='text' name='remarks17' value='{$timecard['remarks17']}' id='remarks17' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>18th </td> <td><select name='available18' id='available18' class='form-control'><option value='{$timecard['available18']}'>"; echo $timecard['available18']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn18' value='{$timecard['timeIn18']}' id='timeIn18' class='form-control' /> </td> <td> <input type='time' name='timeOut18' value='{$timecard['timeOut18']}' id='timeOut18' class='form-control' />  </td> <td> <input type='text' name='remarks18' value='{$timecard['remarks18']}' id='remarks18' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>19th </td> <td><select name='available19' id='available19' class='form-control'><option value='{$timecard['available19']}'>"; echo $timecard['available19']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn19' value='{$timecard['timeIn19']}' id='timeIn19' class='form-control' /> </td> <td> <input type='time' name='timeOut19' value='{$timecard['timeOut19']}' id='timeOut19' class='form-control' />  </td> <td> <input type='text' name='remarks19' value='{$timecard['remarks19']}' id='remarks19' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>20th </td> <td><select name='available20' id='available20' class='form-control'><option value='{$timecard['available20']}'>"; echo $timecard['available20']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn20' value='{$timecard['timeIn20']}' id='timeIn20' class='form-control' /> </td> <td> <input type='time' name='timeOut20' value='{$timecard['timeOut20']}' id='timeOut20' class='form-control' />  </td> <td> <input type='text' name='remarks20' value='{$timecard['remarks20']}' id='remarks20' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>21st </td> <td><select name='available21' id='available21' class='form-control'><option value='{$timecard['available21']}'>"; echo $timecard['available21']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn21' value='{$timecard['timeIn21']}' id='timeIn21' class='form-control' /> </td> <td> <input type='time' name='timeOut21' value='{$timecard['timeOut21']}' id='timeOut21' class='form-control' />  </td> <td> <input type='text' name='remarks21' value='{$timecard['remarks21']}' id='remarks21' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>22nd </td> <td><select name='available22' id='available22' class='form-control'><option value='{$timecard['available22']}'>"; echo $timecard['available22']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn22' value='{$timecard['timeIn22']}' id='timeIn22' class='form-control' /> </td> <td> <input type='time' name='timeOut22' value='{$timecard['timeOut22']}' id='timeOut22' class='form-control' />  </td> <td> <input type='text' name='remarks22' value='{$timecard['remarks22']}' id='remarks22' class='form-control' />  </td> </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>23rd </td> <td><select name='available23' id='available23' class='form-control'><option value='{$timecard['available23']}'>"; echo $timecard['available23']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn23' value='{$timecard['timeIn23']}' id='timeIn23' class='form-control' /> </td> <td> <input type='time' name='timeOut23' value='{$timecard['timeOut23']}' id='timeOut23' class='form-control' />  </td> <td> <input type='text' name='remarks23' value='{$timecard['remarks23']}' id='remarks23' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>24th </td> <td><select name='available24' id='available24' class='form-control'><option value='{$timecard['available24']}'>"; echo $timecard['available24']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn24' value='{$timecard['timeIn24']}' id='timeIn24' class='form-control' /> </td> <td> <input type='time' name='timeOut24' value='{$timecard['timeOut24']}' id='timeOut24' class='form-control' />  </td> <td> <input type='text' name='remarks24' value='{$timecard['remarks24']}' id='remarks24' class='form-control' />  </td> </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>25th </td> <td><select name='available25' id='available25' class='form-control'><option value='{$timecard['available25']}'>"; echo $timecard['available25']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn25' value='{$timecard['timeIn25']}' id='timeIn25' class='form-control' /> </td> <td> <input type='time' name='timeOut25' value='{$timecard['timeOut25']}' id='timeOut25' class='form-control' />  </td> <td> <input type='text' name='remarks25' value='{$timecard['remarks25']}' id='remarks25' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>26th </td> <td><select name='available26' id='available26' class='form-control'><option value='{$timecard['available26']}'>"; echo $timecard['available26']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn26' value='{$timecard['timeIn26']}' id='timeIn26' class='form-control' /> </td> <td> <input type='time' name='timeOut26' value='{$timecard['timeOut26']}' id='timeOut26' class='form-control' />  </td> <td> <input type='text' name='remarks26' value='{$timecard['remarks26']}' id='remarks26' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>27th </td> <td><select name='available27' id='available27' class='form-control'><option value='{$timecard['available27']}'>"; echo $timecard['available27']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn27' value='{$timecard['timeIn27']}' id='timeIn27' class='form-control' /> </td> <td> <input type='time' name='timeOut27' value='{$timecard['timeOut27']}' id='timeOut27' class='form-control' />  </td> <td> <input type='text' name='remarks27' value='{$timecard['remarks27']}' id='remarks27' class='form-control' />  </td> </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>28th </td> <td><select name='available28' id='available28' class='form-control'><option value='{$timecard['available28']}'>"; echo $timecard['available28']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn28' value='{$timecard['timeIn28']}' id='timeIn28' class='form-control' /> </td> <td> <input type='time' name='timeOut28' value='{$timecard['timeOut28']}' id='timeOut28' class='form-control' />  </td> <td> <input type='text' name='remarks28' value='{$timecard['remarks28']}' id='remarks28' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>29th </td> <td><select name='available29' id='available29' class='form-control'><option value='{$timecard['available29']}'>"; echo $timecard['available29']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn29' value='{$timecard['timeIn29']}' id='timeIn29' class='form-control' /> </td> <td> <input type='time' name='timeOut29' value='{$timecard['timeOut29']}' id='timeOut29' class='form-control' />  </td> <td> <input type='text' name='remarks29' value='{$timecard['remarks29']}' id='remarks29' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>30th </td> <td><select name='available30' id='available30' class='form-control'><option value='{$timecard['available30']}'>"; echo $timecard['available30']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn30' value='{$timecard['timeIn30']}' id='timeIn30' class='form-control' /> </td> <td> <input type='time' name='timeOut30' value='{$timecard['timeOut30']}' id='timeOut30' class='form-control' />  </td> <td> <input type='text' name='remarks30' value='{$timecard['remarks30']}' id='remarks30' class='form-control' />  </td>  </tr>
				        	<tr class='<?php echo $tClass ?>'>  <td>31st </td> <td><select name='available31' id='available31' class='form-control'><option value='{$timecard['available31']}'>"; echo $timecard['available31']; echo "</option><option value='present'>Present</option><option value='absent'>Absent</option></select> </td> <td> <input type='time' name='timeIn31' value='{$timecard['timeIn31']}' id='timeIn31' class='form-control' /> </td> <td> <input type='time' name='timeOut31' value='{$timecard['timeOut31']}' id='timeOut31' class='form-control' />  </td> <td> <input type='text' name='remarks31' value='{$timecard['remarks31']}' id='remarks31' class='form-control' />  </td>  </tr>
				        	
							"
                        	 ?> 
                        </table>
                       </div>
                      </div>
                       
                        
                        
							
						<?php 
							 echo br(2);
						if($timecard['status'] != 'Pending Approval' & $timecard['status'] != 'Approved'){ 
							 echo form_submit('edit', 'Edit Time-card', "class=' btn btn-lg btn-block $buttonclass' id='edit'"); 
							 echo br(); 
							 echo form_submit('update', 'Save Time-card', "class=' btn btn-lg btn-block $buttonclass' id='update'"); 
							 echo br(); 
							 echo form_submit('submit', 'Submit Time-card for Approval', "class=' btn btn-lg btn-block btn-warning' id='submit'"); 
						}
							
							// Form Close
							echo form_close(); 
						?>							
							
						
							
					</div> 			
							     
				</div> <!-- PPB-->
						</fieldset>
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
<script>

			//Hiding fields depending on the availabiltity status
		hideFields();
		
		$("#available1").change(function(){
	  		
	  		hideFields();
	 });
	  	
		$("#available2").change(function(){
	  		
	  		hideFields();
	 });
	  	
		$("#available3").change(function(){
	  		
	  		hideFields();
	 });
	  	
		$("#available4").change(function(){
	  		
	  		hideFields();
	 });
		$("#available5").change(function(){
	  		
	  		hideFields();
	 });
		$("#available6").change(function(){
	  		
	  		hideFields();
	 });
		$("#available7").change(function(){
	  		
	  		hideFields();
	 });
		$("#available8").change(function(){
	  		
	  		hideFields();
	 });
		$("#available9").change(function(){
	  		
	  		hideFields();
	 });
		$("#available10").change(function(){
	  		
	  		hideFields();
	 });
		$("#available11").change(function(){
	  		
	  		hideFields();
	 });
		$("#available12").change(function(){
	  		
	  		hideFields();
	 });
		$("#available13").change(function(){
	  		
	  		hideFields();
	 });
		$("#available14").change(function(){
	  		
	  		hideFields();
	 });
		$("#available15").change(function(){
	  		
	  		hideFields();
	 });
		$("#available16").change(function(){
	  		
	  		hideFields();
	 });
		$("#available17").change(function(){
	  		
	  		hideFields();
	 });
		$("#available18").change(function(){
	  		
	  		hideFields();
	 });
		$("#available19").change(function(){
	  		
	  		hideFields();
	 });
		$("#available20").change(function(){
	  		
	  		hideFields();
	 });
		$("#available21").change(function(){
	  		
	  		hideFields();
	 });
		$("#available22").change(function(){
	  		
	  		hideFields();
	 });
		$("#available23").change(function(){
	  		
	  		hideFields();
	 });
		$("#available24").change(function(){
	  		
	  		hideFields();
	 });
		$("#available25").change(function(){
	  		
	  		hideFields();
	 });
		$("#available26").change(function(){
	  		
	  		hideFields();
	 });
		$("#available27").change(function(){
	  		
	  		hideFields();
	 });
		$("#available28").change(function(){
	  		
	  		hideFields();
	 });
		$("#available29").change(function(){
	  		
	  		hideFields();
	 });
		$("#available30").change(function(){
	  		
	  		hideFields();
	 });
		$("#available31").change(function(){
	  		
	  		hideFields();
	 });
	  	
	function hideFields(){
	  	
	  	if($("#available1").val()=='absent' ||$("#available1").val()=='on leave'){
	  		$("#timeIn1").prop('disabled', true);
	  		$("#timeOut1").prop('disabled', true);
	  		$("#timeIn1").val("");
	  		$("#timeOut1").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn1").prop('disabled', false);
	  		$("#timeOut1").prop('disabled', false);
	  	}
	  	
	  	if($("#available2").val()=='absent' ||$("#available2").val()=='on leave'){
	  		$("#timeIn2").prop('disabled', true);
	  		$("#timeOut2").prop('disabled', true);
	  		$("#timeIn2").val("");
	  		$("#timeOut2").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn2").prop('disabled', false);
	  		$("#timeOut2").prop('disabled', false);
	  	}
	  	
	  	if($("#available3").val()=='absent' ||$("#available3").val()=='on leave'){
	  		$("#timeIn3").prop('disabled', true);
	  		$("#timeOut3").prop('disabled', true);
	  		$("#timeIn3").val("");
	  		$("#timeOut3").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn3").prop('disabled', false);
	  		$("#timeOut3").prop('disabled', false);
	  	}
	  	
	  	if($("#available4").val()=='absent' ||$("#available4").val()=='on leave'){
	  		$("#timeIn4").prop('disabled', true);
	  		$("#timeOut4").prop('disabled', true);
	  		$("#timeIn4").val("");
	  		$("#timeOut4").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn4").prop('disabled', false);
	  		$("#timeOut4").prop('disabled', false);
	  	}
	  	
	  	if($("#available5").val()=='absent' ||$("#available5").val()=='on leave'){
	  		$("#timeIn5").prop('disabled', true);
	  		$("#timeOut5").prop('disabled', true);
	  		$("#timeIn5").val("");
	  		$("#timeOut5").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn5").prop('disabled', false);
	  		$("#timeOut5").prop('disabled', false);
	  	}
	  	
	  	if($("#available6").val()=='absent' ||$("#available6").val()=='on leave'){
	  		$("#timeIn6").prop('disabled', true);
	  		$("#timeOut6").prop('disabled', true);
	  		$("#timeIn6").val("");
	  		$("#timeOut6").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn6").prop('disabled', false);
	  		$("#timeOut6").prop('disabled', false);
	  	}
	  	
	  	if($("#available7").val()=='absent' ||$("#available7").val()=='on leave'){
	  		$("#timeIn7").prop('disabled', true);
	  		$("#timeOut7").prop('disabled', true);
	  		$("#timeIn7").val("");
	  		$("#timeOut7").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn7").prop('disabled', false);
	  		$("#timeOut7").prop('disabled', false);
	  	}
	  	
	  	if($("#available8").val()=='absent' ||$("#available8").val()=='on leave'){
	  		$("#timeIn8").prop('disabled', true);
	  		$("#timeOut8").prop('disabled', true);
	  		$("#timeIn8").val("");
	  		$("#timeOut8").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn8").prop('disabled', false);
	  		$("#timeOut8").prop('disabled', false);
	  	}
	  	
	  	if($("#available9").val()=='absent' ||$("#available9").val()=='on leave'){
	  		$("#timeIn9").prop('disabled', true);
	  		$("#timeOut9").prop('disabled', true);
	  		$("#timeIn9").val("");
	  		$("#timeOut9").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn9").prop('disabled', false);
	  		$("#timeOut9").prop('disabled', false);
	  	}
	  	
	  	if($("#available10").val()=='absent' ||$("#available10").val()=='on leave'){
	  		$("#timeIn10").prop('disabled', true);
	  		$("#timeOut10").prop('disabled', true);
	  		$("#timeIn10").val("");
	  		$("#timeOut10").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn10").prop('disabled', false);
	  		$("#timeOut10").prop('disabled', false);
	  	}
	  	
	  	if($("#available11").val()=='absent' ||$("#available11").val()=='on leave'){
	  		$("#timeIn11").prop('disabled', true);
	  		$("#timeOut11").prop('disabled', true);
	  		$("#timeIn11").val("");
	  		$("#timeOut11").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn11").prop('disabled', false);
	  		$("#timeOut11").prop('disabled', false);
	  	}
	  	
	  	if($("#available12").val()=='absent' ||$("#available12").val()=='on leave'){
	  		$("#timeIn12").prop('disabled', true);
	  		$("#timeOut12").prop('disabled', true);
	  		$("#timeIn12").val("");
	  		$("#timeOut12").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn12").prop('disabled', false);
	  		$("#timeOut12").prop('disabled', false);
	  	}
	  	
	  	if($("#available13").val()=='absent' ||$("#available13").val()=='on leave'){
	  		$("#timeIn13").prop('disabled', true);
	  		$("#timeOut13").prop('disabled', true);
	  		$("#timeIn13").val("");
	  		$("#timeOut13").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn13").prop('disabled', false);
	  		$("#timeOut13").prop('disabled', false);
	  	}
	  	
	  	if($("#available14").val()=='absent' ||$("#available14").val()=='on leave'){
	  		$("#timeIn14").prop('disabled', true);
	  		$("#timeOut14").prop('disabled', true);
	  		$("#timeIn14").val("");
	  		$("#timeOut14").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn14").prop('disabled', false);
	  		$("#timeOut14").prop('disabled', false);
	  	}
	  	
	  	if($("#available15").val()=='absent' ||$("#available15").val()=='on leave'){
	  		$("#timeIn15").prop('disabled', true);
	  		$("#timeOut15").prop('disabled', true);
	  		$("#timeIn15").val("");
	  		$("#timeOut15").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn15").prop('disabled', false);
	  		$("#timeOut15").prop('disabled', false);
	  	}
	  	
	  	if($("#available16").val()=='absent' ||$("#available16").val()=='on leave'){
	  		$("#timeIn16").prop('disabled', true);
	  		$("#timeOut16").prop('disabled', true);
	  		$("#timeIn16").val("");
	  		$("#timeOut16").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn16").prop('disabled', false);
	  		$("#timeOut16").prop('disabled', false);
	  	}
	  	
	  	if($("#available17").val()=='absent' ||$("#available17").val()=='on leave'){
	  		$("#timeIn17").prop('disabled', true);
	  		$("#timeOut17").prop('disabled', true);
	  		$("#timeIn17").val("");
	  		$("#timeOut17").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn17").prop('disabled', false);
	  		$("#timeOut17").prop('disabled', false);
	  	}
	  	
	  	if($("#available18").val()=='absent' ||$("#available18").val()=='on leave'){
	  		$("#timeIn18").prop('disabled', true);
	  		$("#timeOut18").prop('disabled', true);
	  		$("#timeIn18").val("");
	  		$("#timeOut18").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn18").prop('disabled', false);
	  		$("#timeOut18").prop('disabled', false);
	  	}
	  	
	  	if($("#available19").val()=='absent' ||$("#available19").val()=='on leave'){
	  		$("#timeIn19").prop('disabled', true);
	  		$("#timeOut19").prop('disabled', true);
	  		$("#timeIn19").val("");
	  		$("#timeOut19").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn19").prop('disabled', false);
	  		$("#timeOut19").prop('disabled', false);
	  	}
	  	
	  	if($("#available20").val()=='absent' ||$("#available20").val()=='on leave'){
	  		$("#timeIn20").prop('disabled', true);
	  		$("#timeOut20").prop('disabled', true);
	  		$("#timeIn20").val("");
	  		$("#timeOut20").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn20").prop('disabled', false);
	  		$("#timeOut20").prop('disabled', false);
	  	}
	  	
	  	if($("#available21").val()=='absent' ||$("#available21").val()=='on leave'){
	  		$("#timeIn21").prop('disabled', true);
	  		$("#timeOut21").prop('disabled', true);
	  		$("#timeIn21").val("");
	  		$("#timeOut21").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn21").prop('disabled', false);
	  		$("#timeOut21").prop('disabled', false);
	  	}
	  	
	  	if($("#available22").val()=='absent' ||$("#available22").val()=='on leave'){
	  		$("#timeIn22").prop('disabled', true);
	  		$("#timeOut22").prop('disabled', true);
	  		$("#timeIn22").val("");
	  		$("#timeOut22").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn22").prop('disabled', false);
	  		$("#timeOut22").prop('disabled', false);
	  	}
	  	
	  	if($("#available23").val()=='absent' ||$("#available23").val()=='on leave'){
	  		$("#timeIn23").prop('disabled', true);
	  		$("#timeOut23").prop('disabled', true);
	  		$("#timeIn23").val("");
	  		$("#timeOut23").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn23").prop('disabled', false);
	  		$("#timeOut23").prop('disabled', false);
	  	}
	  	
	  	if($("#available24").val()=='absent' ||$("#available24").val()=='on leave'){
	  		$("#timeIn24").prop('disabled', true);
	  		$("#timeOut24").prop('disabled', true);
	  		$("#timeIn24").val("");
	  		$("#timeOut24").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn24").prop('disabled', false);
	  		$("#timeOut24").prop('disabled', false);
	  	}
	  	
	  	if($("#available25").val()=='absent' ||$("#available25").val()=='on leave'){
	  		$("#timeIn25").prop('disabled', true);
	  		$("#timeOut25").prop('disabled', true);
	  		$("#timeIn25").val("");
	  		$("#timeOut25").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn25").prop('disabled', false);
	  		$("#timeOut25").prop('disabled', false);
	  	}
	  	
	  	if($("#available26").val()=='absent' ||$("#available26").val()=='on leave'){
	  		$("#timeIn26").prop('disabled', true);
	  		$("#timeOut26").prop('disabled', true);
	  		$("#timeIn26").val("");
	  		$("#timeOut26").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn26").prop('disabled', false);
	  		$("#timeOut26").prop('disabled', false);
	  	}
	  	
	  	if($("#available27").val()=='absent' ||$("#available27").val()=='on leave'){
	  		$("#timeIn27").prop('disabled', true);
	  		$("#timeOut27").prop('disabled', true);
	  		$("#timeIn27").val("");
	  		$("#timeOut27").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn27").prop('disabled', false);
	  		$("#timeOut27").prop('disabled', false);
	  	}
	  	
	  	if($("#available28").val()=='absent' ||$("#available28").val()=='on leave'){
	  		$("#timeIn28").prop('disabled', true);
	  		$("#timeOut28").prop('disabled', true);
	  		$("#timeIn28").val("");
	  		$("#timeOut28").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn28").prop('disabled', false);
	  		$("#timeOut28").prop('disabled', false);
	  	}
	  	
	  	if($("#available29").val()=='absent' ||$("#available29").val()=='on leave'){
	  		$("#timeIn29").prop('disabled', true);
	  		$("#timeOut29").prop('disabled', true);
	  		$("#timeIn29").val("");
	  		$("#timeOut29").val("");
	  		$("#timeOut29").show();
	  		setTimeout(function(){
	  			$("#timeOut29").hide('slide');
	  			$("#timeIn29").hide('slide');
	  		}, 2000);
	  		
	  	} 
	  	else{
	  		$("#timeIn29").prop('disabled', false);
	  		$("#timeOut29").prop('disabled', false);
	  		$("#timeOut29").show("slow");
	  		$("#timeIn29").show("slow");
	  	}
	  	
	  	if($("#available30").val()=='absent' ||$("#available30").val()=='on leave'){
	  		$("#timeIn30").prop('disabled', true);
	  		$("#timeOut30").prop('disabled', true);
	  		$("#timeIn30").val("");
	  		$("#timeOut30").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn30").prop('disabled', false);
	  		$("#timeOut30").prop('disabled', false);
	  	}
	  	
	  	if($("#available31").val()=='absent' ||$("#available31").val()=='on leave'){
	  		$("#timeIn31").prop('disabled', true);
	  		$("#timeOut31").prop('disabled', true);
	  		$("#timeIn31").val("");
	  		$("#timeOut31").val("");
	  		
	  	} 
	  	else{
	  		$("#timeIn31").prop('disabled', false);
	  		$("#timeOut31").prop('disabled', false);
	  	}
	  	
	  	
	  	
	  	
	 }
	  


</script>

</html>