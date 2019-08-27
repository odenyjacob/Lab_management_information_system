<?php
/*
	if($access['timecardApproval']!='yes'){
		redirect('main/unauthorized');
	} */
	
	if($this->session->userdata('userName')==""){
		?> <script> alert('Your session has expired! Login to continue!'); windows.location(<?= base_url(); ?> </script> <?php
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
   <!-- Data table common JS -->
   
  <!-- <script type="text/javascript" src="<?= base_url('/public/js/jquery.js') ?>" ></script> -->
<script type="text/javascript" src="<?= base_url('/public/js/validation/jquery.validationEngine-en.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('/public/js/validation/jquery.validationEngine.js'); ?>"></script>
<link href="<?= base_url('/public/css/validation/validationEngine.jquery.css'); ?>" type="text/css" rel="stylesheet" />

<link rel="stylesheet" href="<?= base_url('/public/css/dataTable/demo_page.css'); ?>" type="text/css" />
<link rel="stylesheet" href="<?= base_url('/public/css/dataTable/demo_table_jui.css'); ?>" type="text/css" />
<link rel="stylesheet" href="<?= base_url('/public/css/dataTable/smoothness/jquery-ui-1.8.4.custom.css'); ?>" type="text/css" />        
<script type="text/javascript" language="javascript" src="<?= base_url('/public/js/dataTable/jquery.dataTables.min.js'); ?>"></script>

<!-- Validation Engine -->
   <link href="<?= base_url('/public/css/validation/validationEngine.jquery.css'); ?>" type="text/css" rel="stylesheet" />   
   <script type="text/javascript" src="<?= base_url('/public/js/validation/jquery.validationEngine-en.js'); ?>"></script>
   <script type="text/javascript" src="<?= base_url('/public/js/validation/jquery.validationEngine.js'); ?>"></script>

<script type="text/javascript" src="<?= base_url('public/fancybox/jquery.fancybox.js?v=2.1.5'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url('public/fancybox/jquery.fancybox.css?v=2.1.5'); ?>" media="screen" />
   
 <style>
    .deleteRecord{
        cursor: pointer;
    }
    
</style>


</head>
<body>
	<div id="full">	
		<div class="row">
			<div class="col-md-12 col-md-offset-0">				 
				<div class="<?php echo $this->session->userdata('panel'); ?>">
			  		<div class="panel-heading">
			    		<h3 class="panel-title" align="center"><?= $this->elisa_id != NULL ? 'EDIT EQA ELISA VIRAL MARKERS' : 'ADD NEW EQA ELISA VIRAL MARKERS'; ?></h3>  
			  		</div>
			  		<div class="panel-body"> 
		    <h1>EQA Elisa Marker Form</h1> <hr />
    <div id="body">

			<?php 
						  $attributes = array('class' => 'form-horizontal row-border', 'id' => 'elisa_form'); 
						 echo form_open('elisa/submitElisa', $attributes) ; 
						 ?>
						
						 <div id="spinner" class="spinner" style="display:none; height: 200px; width: 200px;">
    						<img id="img-spinner" src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading"/>
						</div>
						    <input type="hidden" name="type" id="type" value="<?= $this->elisa_id != NULL ? 'updateElisa' : 'addElisa'; ?>" />
						    <input type="hidden" name="elisa_id" id="elisa_id" value="<?= $this->elisa_id; ?>" />
							<input type="hidden" name="popup" value="true"/>
							<label>Year</label>
							<input type="text" min="2010" name="year" id="year" class="form-control validate[required, minSize[4], maxSize[4], custom[number]]" value="<?= $this->year ; ?>"/>
							<label>Cycle</label>
						 	<select name="cycle" id="cycle" class="form-control validate[required, custom[onlyLetterSp]]">
						 		<option value="<?= $this->cycle ?>"><?= $this->cycle != NULL ? $this->cycle : 'Select Cycle' ?> </option>
						 		<option value="A">A</option>
						 		<option value="B">B</option>
						 		<option value="C">C</option>
						 	</select>
							<label>Parameter</label>
						 	<select name="parameter" id="parameter" class="form-control validate[required]">
						 		<option value="<?= $this->parameter ?>"><?= $this->parameter != NULL ? $this->parameter : 'Select Parameter' ?> </option>
						 		<option value="Anti-HIV-1/2">Anti-HIV-1/2</option>
						 		<option value="Anti-HBc (Total)">Anti-HBc (Total)</option>
						 		<option value="Anti-HCV">Anti-HCV</option>
						 		<option value="Anti-HIV-1 (Mtd 1)">Anti-HIV-1 (Mtd 1)</option>
						 		<option value="Anti-HIV-1 (Mtd 2)">Anti-HIV-1 (Mtd 2)</option>
						 		<option value="Anti-HIV-1 WB Proteins">Anti-HIV-1 WB Proteins</option>
						 		<option value="Anti-HIV-1 WB, Result">Anti-HIV-1 WB, Result</option>
						 		<option value="HBeAg">HBeAg</option>
						 		<option value="HBsAg">HBsAg</option>
						 	</select>
						 <?php 
							/* Rejected Samples
							echo form_label('IQCs Passed on First Run');
							$data_name = array(
							'type' => 'number',
							'name' => 'iqcs_passed_firstRun',
							'class' => 'form-control validate[required]',
							'placeholder' => 'Enter IQCs Passed on First Run',
							'id' => 'iqcs_passed_firstRun',
							'required' => 'required',
							'value' => $this->iqcs_passed_firstRun,
							//'autofocus' => true,
							);
							echo form_input($data_name);
							echo br();
							*/
							
							echo form_label('Cycle Result for the Parameter');
							$data_name = array(
							'type' => 'number',
							'name' => 'results',
							'class' => 'form-control validate[required]',
							'placeholder' => 'Enter the result for the Parameter',
							'id' => 'results',
							'value' => $this->results,
							);
							echo form_input($data_name); 
							echo br();
							
						
							echo form_label('Target ');
							$data_name = array(
							'type' => 'number',
							'name' => 'target',
							'class' => 'form-control',
							'placeholder' => 'Enter Target for the Parameter',
							'id' => 'target',
							'required' => 'required',
							'value' => $this->target,
							);
							echo form_input($data_name); 
							echo br(2);
			  			
			  			
			  			echo form_submit('submit', 'Submit', "class=' btn btn-lg btn-block $buttonclass' id='submit'");
						echo form_close();
						?>
       
        
    </div>  			
			  			

            <!--end datatable--> 
			  			
			  			
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
    $(document).ready(function() {
			$("#submit").click(function(event){
				event.preventDefault();
				save();
			});
            $("#elisa_form").validationEngine();
        });
        //this function for menu selecting
       // menuSelect("menuBrands");
        
        
        function save() {
        	//event.preventDefault();
            
            var validate =  $('#elisa_form').validationEngine("validate");
            if(!validate){
                return false;
            }
            
			$("#submit").hide();
			
            var type = $("#type").val();
            var elisa_id = $("#elisa_id").val();
            var year = $("#year").val();
            var parameter = $("#parameter").val();
            var cycle = $("#cycle").val();
            var results = $("#results").val();
            var target = $("#target").val();
            
           $.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "index.php/elisa/submitElisa",
			dataType: 'json',
			data: {type: type, year: year, cycle: cycle, results: results,
					parameter: parameter, target: target, elisa_id: elisa_id, 
					},
			beforeSend: function() {
				$("#spinner").show();
             },
			success: function(res) { 
				$("#spinner").hide();
				alert('Data submitted Successfully!');
				parent.$.fancybox.close();			
			},
			error: function(e){
				$("#spinner").hide();
				alert('Error! Check if this is not a duplicate then try again!');
				$("#submit").show();
			}
	});
	}		
		
</script>




</html>
