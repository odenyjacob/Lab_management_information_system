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
			    		<h3 class="panel-title" align="center"><?= $this->id != NULL ? 'EDIT USER' : 'ADD USER'; ?></h3>  
			  		</div>
			  		<div class="panel-body"> 
		    <h1>Users</h1> <hr />
    <div id="body">
 
			<?php 
				$attributes = array('class' => 'form-horizontal row-border', 'id' => 'usersForm'); 
				echo form_open('users/submitUser', $attributes) ; 
			?>
						 
						 <div id="spinner" class="spinner" style="display:none; height: 200px; width: 200px;">
    						<img id="img-spinner" src="<?php echo base_url(); ?>assets/img/ajax-loader.gif" alt="Loading"/>
						</div>
						    <input type="hidden" name="type" id="type" value="<?= $this->id != NULL ? 'updateUser' : 'addUser'; ?>" />
						    <input type="hidden" name="id" id="id" value="<?= $this->id; ?>" />
						 
						 <?php 
							// First Name
							echo form_label('First Name');
							$data_name = array(
							'type' => 'text',
							'name' => 'FName',
							'class' => 'form-control validate[required]',
							'placeholder' => 'Enter First Name',
							'id' => 'FName',
							'required' => 'required',
							'value' => $this->FName,
							);
							echo form_input($data_name);
							echo br(); 

							// Last Name
							echo form_label('Last Name');
							$data_name = array(
							'type' => 'text',
							'name' => 'LName',
							'class' => 'form-control validate[required]',
							'placeholder' => 'Enter Last Name',
							'id' => 'LName',
							'required' => 'required',
							'value' => $this->LName,
							);
							echo form_input($data_name);
							echo br(); 
						
							// Username
							echo form_label('Username');
							$data_name = array(
							'type' => 'text',
							'name' => 'userName',
							'class' => 'form-control validate[required]',
							'placeholder' => 'Enter Username',
							'id' => 'userName',
							'required' => 'required',
							'value' => $this->userName,
							);
							echo form_input($data_name);								
							 
							
							echo br(2);
			  			
			  			
			  			echo form_submit('submit', 'Submit User', "class=' btn btn-lg btn-block $buttonclass' id='submit'");
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
            $("#usersForm").validationEngine(); 
        });
        
        function save() {
        	var validate =  $('#usersForm').validationEngine("validate");
            if(!validate){
                return false;
            }
            
            $("#submit").hide();
			
            var type = $("#type").val();
            var id = $("#id").val();
            var FName = $("#FName").val();
            var LName = $("#LName").val(); 
            var userName = $("#userName").val(); 
               
	        	 $.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>" + "index.php/users/submitUser",
					dataType: 'json',
					data: {type: type, id: id, FName: FName, LName: LName, userName:userName},  
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
