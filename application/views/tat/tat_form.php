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
			    		<h3 class="panel-title" align="center"><?= $this->tat_id != NULL ? 'EDIT TAT' : 'ADD NEW TAT'; ?></h3>  
			  		</div>
			  		<div class="panel-body"> 
		    <h1>TAT Form</h1> <hr />
    <div id="body">


           

			<?php 
						  $attributes = array('class' => 'form-horizontal row-border', 'id' => 'tat_form'); 
						 echo form_open('tat/submitTat', $attributes) ; 
						 ?>
						 
						 <div id="spinner" class="spinner" style="display:none; height: 200px; width: 200px;">
    						<img id="img-spinner" src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Wait..."/>
						</div>
						    <input type="hidden" name="type" id="type" value="<?= $this->tat_id != NULL ? 'updateTat' : 'addTat'; ?>" />
						    <input type="hidden" name="tat_id" id="tat_id" value="<?= $this->tat_id; ?>" />
							<input type="hidden" name="popup" value="true"/>
							<input type="hidden" name="userName" value="<?= $this->session->userdata('userName'); ?>"/>
							<label>Year</label>
							<input type="text" min="2010" name="year" id="year" class="form-control validate[required, minSize[4], maxSize[4], custom[number]]" value="<?= $this->year ; ?>"/>
							<label>Month</label>
						 	<select name="month" id="month" class="form-control validate[required, custom[onlyLetterSp]]">
						 		<option value="<?= $this->month ?>"><?= $this->month != NULL ? $this->month : 'Select Month' ?> </option>
						 		<option value="JAN">January</option>
						 		<option value="FEB">February</option>
						 		<option value="MAR">March</option>
						 		<option value="APR">April</option>
						 		<option value="MAY">May</option>
						 		<option value="JUN">June</option>
						 		<option value="JUL">July</option>
						 		<option value="AUG">August</option>
						 		<option value="SEP">September</option>
						 		<option value="OCT">October</option>
						 		<option value="NOV">November</option>
						 		<option value="DEC">December</option>
						 	</select>
						 <?php 
							// Rejected Samples
							echo form_label('No. of Samples Not Meeting TAT');
							$data_name = array(
							'type' => 'number',
							'name' => 'samples_not_meeting_tat',
							'class' => 'form-control validate[required]',
							'placeholder' => 'Enter No. of samples not meeting TAT',
							'id' => 'samples_not_meeting_tat',
							'required' => 'required',
							'value' => $this->samples_not_meeting_tat,
							//'autofocus' => true,
							);
							echo form_input($data_name);
							echo br();
							
							// Middle Name Field
							echo form_label('Total No. of Samples Released');
							$data_name = array(
							'type' => 'number',
							'name' => 'total_samples_released',
							'class' => 'form-control validate[required]',
							'placeholder' => 'Enter Total No. of Samples Resleased',
							'id' => 'total_samples_released',
							'value' => $this->total_samples_released,
							);
							echo form_input($data_name); 
							echo br();
							
							// Last Name Field
							echo form_label('Target ');
							$data_name = array(
							'type' => 'number',
							'name' => 'target',
							'class' => 'form-control',
							'placeholder' => 'Enter Target',
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
            $("#tat_form").validationEngine(); 
        });
     
        
        function save() {
        	//event.preventDefault();
            
            var validate =  $('#tat_form').validationEngine("validate");
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
            var tat_id = $("#tat_id").val();
            var year = $("#year").val();
            var month = $("#month").val();
            var samples_not_meeting_tat = $("#samples_not_meeting_tat").val();
            var total_samples_released = $("#total_samples_released").val();
            var target = $("#target").val();
            
           $.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "index.php/tat/submitTat",
			dataType: 'json',
			data: {type: type, year: year, month: month, samples_not_meeting_tat: samples_not_meeting_tat, 
					total_samples_released: total_samples_released, target: target, tat_id: tat_id, 
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
            
          //  var submit = $('#tat_form').serialize();
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
