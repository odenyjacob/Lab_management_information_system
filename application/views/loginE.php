<!DOCTYPE html>
<html>
    <head>
    	<title><?php echo $title ?></title> 
        <meta charset="UTF-8">		
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta content='width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes' name='viewport'>
        <meta name="description" content="" />
        <meta name="author" content="" />
        
        <?php $username = $this->session->userdata('username');?>
        <?php $role = $this->session->userdata('role');?>      
      
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url('assets/dashboard/css/bootstrap.min.css') ?>" rel="stylesheet">            
        <!-- font Awesome -->
        <link href="<?php echo base_url('assets/dashboard/css/font-awesome.min.css') ?>" rel="stylesheet">
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/dashboard/css/ionicons.min.css') ?>" rel="stylesheet">
        <!-- Morris chart -->
        <link href="<?php echo base_url('assets/dashboard/css/morris/morris.css') ?>" rel="stylesheet">
        <!-- Timeline CSS -->
        <link href="<?php echo base_url('assets/dashboard/css/plugins/timeline.css') ?>" rel="stylesheet">
        <!-- Metis Menu CSS-->
        <link href="<?php echo base_url('assets/dashboard/css/plugins/metisMenu/metisMenu.min.css') ?>" rel="stylesheet">
        <!-- Daterange picker -->
        <link href="<?php echo base_url('assets/dashboard/css/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet">
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo base_url('assets/dashboard/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>" rel="stylesheet">
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/dashboard/css/AdminLTE.css') ?>" rel="stylesheet">
        
         <!-- Jquery UI Javascript-->
    <script src="<?php echo base_url('assets/jquery-ui/jquery-ui.min.js') ?>"></script>
    
    <link href="<?php echo base_url('assets/jquery-ui/jquery-ui.min.css') ?>" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
     <style>
	body{ 
		background-image:  no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	</style>
	<script>
		  
		  $(function() {
		    $( "#dialog" ).dialog();
		  });
  
  </script>
    </head> 
    <body style="background-image: url('assets/img/ksm.jpg');">
       
                <!-- Main content -->
     <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            	<?php echo br(3); ?>
            	<div id="dialog">
                <div class="login-panel panel panel-default" style="opacity: 0.6;">                	
                    <div class="panel-heading"> 					
						<?php echo br(3); echo validation_errors(); ?>
                    	<?php echo form_open('main/login_proc'); ?>
                        <h3 class="panel-title skin blue">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>                            	
                                <div class="form-group">
                                	<center>
                                	<?php if (isset($error)){?>     
                                	<span class="label label-danger">                                	
                                	<?php  echo $error ; ?> 
                                	</span> <?php }?>
                                	</center>
                                	<br /> 
                                    
                               
								<?php
								$data = array(
												'name' => 'userName',
												'type' => 'text',
												'autofocus' => 'true',
												'placeholder' => 'Username',
												'class' => 'form-control',
																				
								
								);
								
								$attributes = array(
									'width' => '600',
									'height' => '800',
									'screenx' => '(window.width-400)/2', 
									'screeny' => '(window.height-300)/2',
								);
								$attr = array(
									'width' => '600',
									'height' => '400',
									'screenx' => '(window.width-600)/2', 
									'screeny' => '(window.height-300)/2',
								);
								echo form_label("Enter Username"); //." (New Member? ". anchor_popup('main/register_user', 'Register', $attributes).")" 
								 echo form_input($data);
								 echo "</div>"; ?>
								 <!--
								 <div class="form-group">
                    <select name="role" class="form-control">
					<option value=" ">Select Your Location</option>
					<option value="Administrative">Kisumu </option>
					<option value="Clinical Officer">Kakamega </option>					
					<option value="Health Recorder">Kitale</option>
					<option value="QA/QC">Nairobi</option>					
					</select>
                        </div> --> <?php 
								 
								 echo form_label("Password", "password")." (Forgot password? " . anchor_popup('main/resetForm', 'Reset', $attr).")";
                                ?> 
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                               <?php echo form_submit('submit', 'LOG IN', 'class="btn btn-lg btn-success btn-block" ' ); ?>  
								
                                <?php echo form_close(); ?> 
                            </fieldset>
							
                        </form>
                    </div>
                </div> 
                </div>
                <?php echo br(4); ?>
				<div class="footer-panel panel panel-default" style="opacity: 0.7;">
							<div>												
								<h6 align="center"> &copy <?php echo date("Y") . " Responsive Africa" ;?>
								<br /> ERP SYSTEM - All Rights Reserved</h6> 
								</div>  
							</div>
            </div>
        </div>
    </div>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo base_url('assets/dashboard/js/jquery-ui-1.10.3.min.js') ?>"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url('assets/dashboard/js/bootstrap.min.js') ?>"></script>
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="<?php echo base_url('assets/dashboard/js/plugins/morris/morris.min.js') ?>"></script>
        <!-- Sparkline -->
        <script src="<?php echo base_url('assets/dashboard/js/plugins/sparkline/jquery.sparkline.min.js') ?>"></script>
        <!-- jvectormap -->
        <script src="<?php echo base_url('assets/dashboard/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/dashboard/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo base_url('assets/dashboard/js/plugins/jqueryKnob/jquery.knob.js') ?>"></script>
        <!-- daterangepicker -->
        <script src="<?php echo base_url('assets/dashboard/js/plugins/daterangepicker/daterangepicker.js') ?>"></script>
        <!-- datepicker -->
        <script src="<?php echo base_url('assets/dashboard/js/plugins/datepicker/bootstrap-datepicker.js') ?>"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo base_url('assets/dashboard/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('assets/dashboard/js/plugins/iCheck/icheck.min.js') ?>"></script>

        <!-- AdminLTE App -->
        <script src="<?php echo base_url('assets/dashboard/js/AdminLTE/app.js') ?>"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo base_url('assets/dashboard/js/AdminLTE/dashboard.js') ?>"></script>
    </body>
</html>