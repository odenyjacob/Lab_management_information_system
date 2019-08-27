<?php
/*
	if($access['timecardApproval']!='yes'){
		redirect('main/unauthorized');
	} */
	if($this->session->userdata('userName')==""){
		$data['error'] = 'Session Expired, Please Login';
		$data['title'] = 'QIMS | Login Error';
		$this->load->view('login', $data);
		exit;
		 }
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> <?php echo $title; ?> </title>
	<?php $buttonclass = $this->session->userdata('buttonClass'); ?>
	<?php $userName = $this->session->userdata('userName'); ?>
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
			    		<h3 class="panel-title" align="center"><?= $this->summaries_id != NULL ? 'EDIT SUMMARIES' : 'ADD NEW SUMMARY'; ?></h3>  
			  		</div>
			  		<div class="panel-body"> 
		    <h1>Summaries Form</h1> <hr />
    <div id="body">


			<?php 
						  $attributes = array('class' => 'form-horizontal row-border', 'id' => 'summaries_form'); 
						 echo form_open('summaries/submitSummaries', $attributes) ; 
						 ?>
						 
						 <div id="spinner" class="spinner" style="display:none; height: 200px; width: 200px;">
    						<img id="img-spinner" src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Wait..."/>
						</div>
						    <input type="hidden" name="type" id="type" value="<?= $this->summaries_id != NULL ? 'updateSummaries' : 'addSummaries'; ?>" />
						    <input type="hidden" name="summaries_id" id="summaries_id" value="<?= $this->summaries_id; ?>" />
							<input type="hidden" name="popup" value="true"/>
							<label>Year</label>
							<input type="text" min="2010" name="year" id="year" class="form-control validate[required, minSize[4], maxSize[4], custom[number]]" value="<?= $this->year ; ?>"/>
							<label>Table</label>
						 	<select name="table_name" id="table_name" class="form-control validate[required]">
						 		<option value="<?= $this->table_name ?>"><?= $this->table_name != NULL ? $this->table_name : 'Select Table' ?> </option>
						 		<option value="SAMPLE REJECTION">SAMPLE REJECTION</option>
						 		<option value="INTERNAL QUALITY CONTROL">INTERNAL QUALITY CONTROL</option>
						 		<option value="CRITICAL VALUE REPORTING">CRITICAL VALUE REPORTING</option>
						 		<option value="EQA-CHEMISTRY">EQA-CHEMISTRY</option>
						 		<option value="EQA-URINALYSIS&CLINICAL MICRO">EQA-URINALYSIS&CLINICAL MICRO</option>
						 		<option value="EQA-HEMATOLOGY">EQA-HEMATOLOGY</option>
						 		<option value="EQA-ELISA VIRAL MARKERS">EQA-ELISA VIRAL MARKERS</option>
						 		<option value="BLOOD CELL,PARASITE&CTNG">BLOOD CELL,PARASITE&CTNG</option>
						 		<option value="EQA-RAPID HIV&OTHERS">EQA-RAPID HIV&OTHERS</option>
						 		<option value="CUSTOMER SATISFACTION">CUSTOMER SATISFACTION</option>
						 		<option value="TAT">TAT</option>
						 	</select>
						 <?php 
							// Analysis
							echo form_label('Analysis for the year and table above');
							$data_name = array(
							'type' => 'text',
							'name' => 'analysis',
							'class' => 'form-control validate[required]',
							'placeholder' => 'Please enter the Analysis for the entered year and the selected table',
							'id' => 'analysis',
							'rows' => 3,
							'required' => 'required',
							'value' => $this->analysis,
							//'autofocus' => true,
							);
							echo form_textarea($data_name);
							echo br();
							echo form_label('Interpretation for the year and table above');
							$data_name = array(
							'type' => 'text',
							'name' => 'interpretation',
							'class' => 'form-control validate[required]',
							'placeholder' => 'Please enter the Interpretation for the entered year and the selected table',
							'id' => 'interpretation',
							'rows' => 3,
							'required' => 'required',
							'value' => $this->interpretation,
							//'autofocus' => true,
							);
							echo form_textarea($data_name);
							echo br();
							echo form_label('Limitation for the year and table above');
							$data_name = array(
							'type' => 'text',
							'name' => 'limitation',
							'class' => 'form-control validate[required]',
							'placeholder' => 'Please enter the Limitation for the entered year and the selected table',
							'id' => 'limitation',
							'rows' => 3,
							'required' => 'required',
							'value' => $this->limitation,
							//'autofocus' => true,
							);
							echo form_textarea($data_name);
							echo br();
							echo form_label('Action Plan for the year and table above');
							$data_name = array(
							'type' => 'text',
							'name' => 'action_plan',
							'class' => 'form-control validate[required]',
							'placeholder' => 'Please enter the Action Plan for the entered year and the selected table',
							'id' => 'action_plan',
							'rows' => 3,
							'required' => 'required',
							'value' => $this->action_plan,
							//'autofocus' => true,
							);
							echo form_textarea($data_name);
							echo br();
							
							
			  			
			  			
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
            $("#summaries_form").validationEngine(); 
        });
     
        
        function save() {
        	//event.preventDefault();
            
            var validate =  $('#summaries_form').validationEngine("validate");
            if(!validate){
                return false;
            }
            
           var username = '<?php echo $userName?>';
           if (typeof username==='undefined'){
           	alert('Session Expired!');
           	return false;
           }
            
			$("#submit").hide();
			
            var type = $("#type").val();
            var summaries_id = $("#summaries_id").val();
            var year = $("#year").val();
            var table_name = $("#table_name").val();
            var analysis = $("#analysis").val();
            var interpretation = $("#interpretation").val();
            var limitation = $("#limitation").val();
            var action_plan = $("#action_plan").val();
            
           $.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "index.php/summaries/submitSummaries",
			dataType: 'json',
			data: {type: type, year: year, table_name: table_name, analysis: analysis, 
					interpretation: interpretation, limitation: limitation, action_plan: action_plan, summaries_id: summaries_id, 
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
            
          //  var submit = $('#summaries_form').serialize();
           // $.ajax({
            //    type: "POST",
             //   url: "<?= base_url('index.php/samples/submitRejection'); ?>",
             //   data: {submit},
             //   beforeSend: function() {
				//	$("#spinner").show();
               // },
               // success: function(resp) {
				//	$("#spinner").hide();					
				//	alert("Submitted successfully!");
				//	document.write("The data you entered was successfully submited.\nYou can click outside this page or close image on the right conner to get back to the main page!");
                //    var response = jQuery.parseJSON(resp);
                    
                 //   parent.$.fancybox.close();
               // },
               // error: function(e) {
				////	$("#spinner").hide();
				//	alert("A Problem has occured! Try again later.");
					
             //   }
            
		
		
</script>




</html>
