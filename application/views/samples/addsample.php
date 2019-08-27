<?php
/*
	if($access['timecardApproval']!='yes'){
		redirect('main/unauthorized');
	} */
	if($this->session->userdata('userName')==""){
		$data['error'] = 'Session Expired, Please Login';
		$data['title'] = 'ERP | Login Error';
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
			    		<h3 class="panel-title" align="center"><?= $this->sample_id != NULL ? 'EDIT SAMPLE' : 'ADD NEW SAMPLE'; ?></h3>  
			  		</div>
			  		<div class="panel-body"> 
		    <h1>Samples Form</h1> <hr />
    <div id="body">


           

			<?php 
						  $attributes = array('class' => 'form-horizontal row-border', 'id' => 'samplesForm'); 
						 echo form_open('samples/submitSamples', $attributes) ; 
						 ?>
						 
						 <div id="spinner" class="spinner" style="display:none; height: 200px; width: 200px;">
    						<img id="img-spinner" src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading"/>
						</div>
						    <input type="hidden" name="type" id="type" value="<?= $this->id != NULL ? 'updateSamples' : 'addSamples'; ?>" />
						    <input type="hidden" name="id" id="id" value="<?= $this->id; ?>" />
							<input type="hidden" name="popup" value="true"/>
							<input type="hidden" name="userName" value="<?= $this->session->userdata('userName'); ?>"/>
							<label>Sample ID</label>
							<input type="text" name="sample_id" id="sample_id" class="form-control validate[required, minSize[3]" value="<?= $this->sample_id ; ?>"/>
							<label>Sample Type</label>
						 	<select name="sample_type" id="sample_type" class="form-control">
						 		<option value="<?= $this->sample_type ?>"><?= $this->sample_type != NULL ? $this->sample_type : 'Select Sample Type' ?> </option>
						 		<?php
									foreach($sample_types as $samplestype)
									{
										echo '<option value="'.$samplestype['sample_type'].'">'.$samplestype['sample_type'].'</option>';
									}
								?>  
						 	</select>
							<label>Project</label>
						 	<select name="project" id="project" class="form-control validate[required]">
						 		<option value="<?= $this->project ?>"><?= $this->project != NULL ? $this->project : 'Select Project' ?> </option>
								 
								 <?php
									foreach($projects as $project)
									{
										echo '<option value="'.$project['project'].'">'.$project['project'].'</option>';
									}
								?>  
						 	</select>
						 <?php 
							// Sample Date
							echo form_label('Sample Date');
							$fieldname = array(
							'type' => 'date',
							'name' => 'sample_date',
							'class' => 'form-control validate[required, custom[date]]',
							'placeholder' => 'Time of Collection',
							'id' => 'sample_date',
							'required' => 'required',
							'value' => $this->sample_date, 
							);
							echo form_input($fieldname);
							echo br();
							
							// Sample Time
							echo form_label('Sample Time');
							$fieldname = array(
							'type' => 'time',
							'name' => 'sample_time',
							'class' => 'form-control validate[required]',
							'placeholder' => 'Time of Collection',
							'id' => 'sample_time',
							'required' => 'required',
							'value' => $this->sample_time, 
							);
							echo form_input($fieldname); 
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
            $("#samplesForm").validationEngine(); 
        });
 
        function save() {
        	//event.preventDefault();
            
            var validate =  $('#samplesForm').validationEngine("validate");
            if(!validate){
                return false;
            }
     
			$("#submit").hide();
			
            var type = $("#type").val();
            var id = $("#id").val();
            var sample_id = $("#sample_id").val();
            var sample_type = $("#sample_type").val(); 
            var project = $("#project").val(); 
            var sample_date = $("#sample_date").val(); 
            var sample_time = $("#sample_time").val(); 
            
           $.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "index.php/samples/submitSamples",
			dataType: 'json',
			data: {
					type: type, sample_id: sample_id, sample_type: sample_type, 
					project: project, id: id, sample_date:sample_date, sample_time:sample_time
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
            
          //  var submit = $('#rejectionForm').serialize();
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
