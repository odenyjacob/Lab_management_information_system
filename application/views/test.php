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
   <!-- Validation Engine -->
   <link href="<?= base_url('/public/css/validation/validationEngine.jquery.css'); ?>" type="text/css" rel="stylesheet" />   
   <script type="text/javascript" src="<?= base_url('/public/js/validation/jquery.validationEngine-en.js'); ?>"></script>
   <script type="text/javascript" src="<?= base_url('/public/js/validation/jquery.validationEngine.js'); ?>"></script>
   
   <!-- Data Table -->
   <link rel="stylesheet" href="<?= base_url('/public/css/dataTable/demo_page.css'); ?>" type="text/css" />
   <link rel="stylesheet" href="<?= base_url('/public/css/dataTable/demo_table_jui.css'); ?>" type="text/css" />
   <link rel="stylesheet" href="<?= base_url('/public/css/dataTable/smoothness/jquery-ui-1.8.4.custom.css'); ?>" type="text/css" />        
   <script type="text/javascript" language="javascript" src="<?= base_url('/public/js/dataTable/jquery.dataTables.min.js'); ?>"></script>


</head>
<body>
	<div id="page-wrapper">	
		<div class="row">
			<div class="col-md-12 col-md-offset-0">				
				<div class="<?php echo $this->session->userdata('panel'); ?>">
			  		<div class="panel-heading">
			    		<h3 class="panel-title" align="center"> :::: ABOUT BLANK :::</h3>  
			  		</div>
			  		<div class="panel-body"> 
					<div id="spinner" class="spinner" style="display:none; ">
    					<img id="img-spinner" src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Wait....."/>
					</div>
	
			  			<?php 
						  $attributes = array('class' => 'form-horizontal row-border', 'id' => 'testForm'); 
						 echo form_open('', $attributes) ; 
							// First Name Field
							echo form_label('Emloyees\' First Name');
							$data_name = array(
							'name' => 'FName',
							'class' => 'form-control validate[required, custom[onlyLetterSp]]',
							'placeholder' => 'Enter First Name',
							'id' => 'FName',
							'required' => 'required',
							'autofocus' => true,
							);
							echo form_input($data_name);
							echo br();
							
							// Middle Name Field
							echo form_label('Emloyees\' Middle Name');
							$data_name = array(
							'type' => 'text',
							'name' => 'MName',
							'class' => 'form-control validate[required]',
							'placeholder' => 'Enter Middle Name',
							'id' => 'MName'
							);
							echo form_input($data_name); 
							echo br();
							
							// Last Name Field
							echo form_label('Emloyees\' Last Name');
							$data_name = array(
							'type' => 'text',
							'name' => 'LName',
							'class' => 'form-control validate[required, custom[onlyLetterSp]]',
							'placeholder' => 'Enter Last Name',
							'id' => 'LName',
							'required' => 'required',
							);
							echo form_input($data_name); 
							echo br();
							
							// Employee Number Field
							echo form_label('Emloyee Number');
							$data_name = array(
							'type' => 'text',
							'name' => 'empNumber',
							'class' => 'form-control textfield validate[required, minSize[4], custom[onlyLetterSp]]',
							'placeholder' => 'Enter Employee Number',
							'id' => 'empNumber',
							'required' => 'required',
							);
							echo form_input($data_name); 
							echo br();
			  			
			  			
			  			echo form_submit('submit', 'Submit', "class=' btn btn-lg btn-block $buttonclass' id='submit'");
						echo form_close();
						
						 ?>
			  			
			  			 
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
			$("#submit").click(function(){
				event.preventDefault();
				save();
			});
            $("#testForm").validationEngine();
        });
        //this function for menu selecting
       // menuSelect("menuBrands");
        
        
        function save() {
            
            var validate =  $('#testForm').validationEngine("validate");
            if(!validate){
                return false;
            }
            var submit = $('#testForm').serialize();
            $.ajax({
                type: "POST",
                url: "<?= base_url('index.php/main/testproc'); ?>",
                data: submit,
                beforeSend: function() {
					$("#spinner").show();
                },
                success: function(resp) {
					$("#spinner").hide();
					alert("Submitted successfully!");
                    var response = jQuery.parseJSON(resp);
                    
                    parent.$.fancybox.close();
                },
                error: function(e) {
					$("#spinner").hide();
					alert("A Problem has occured! Try again later.");
                }
            });
		}

</script>


</html>