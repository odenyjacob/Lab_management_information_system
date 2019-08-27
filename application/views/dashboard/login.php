<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">		
        <title><?php echo $title ?></title> 
			
        
        <meta content='width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url('assets/dashboard/css/bootstrap.min.css') ?>" rel="stylesheet">
        <?php $username = $this->session->userdata('username');?>
        <?php $role = $this->session->userdata('role');?>
        
        <!-- font Awesome -->
        <link href="<?php echo base_url('assets/dashboard/css/font-awesome.min.css') ?>" rel="stylesheet">
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/dashboard/css/ionicons.min.css') ?>" rel="stylesheet">
        <!-- Morris chart -->
        <link href="<?php echo base_url('assets/dashboard/css/morris/morris.css') ?>" rel="stylesheet">
        <!-- jvectormap -->
        <link href="<?php echo base_url('assets/dashboard/css/jvectormap/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet">
        <!-- Date Picker -->
        <link href="<?php echo base_url('assets/dashboard/css/datepicker/datepicker3.css') ?>" rel="stylesheet">
        <!-- Daterange picker -->
        <link href="<?php echo base_url('assets/dashboard/css/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet">
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo base_url('assets/dashboard/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>" rel="stylesheet">
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/dashboard/css/AdminLTE.css') ?>" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header" style="position: fixed;">
            <a href="#" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
               KPA Online Portal
            </a>
            
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
					 <a href="#" style="color: white;">
					Kenya Pharmaceutical Association
					</a>
                        <!-- User Account: style can be found in dropdown.less
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span> <?php echo $username; ?> <i class="caret"></i></span>
                            </a>
							
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <img src="../agent/img/logo.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $role; ?>
                                    </p>
                                </li>     
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>                           
                            </ul> 
							
                        </li>-->
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas" style="position: fixed;">
                
                <section class="sidebar">
                   
                    
                        <div class="pull-left image">
                           <a href="#"> <?php echo img('assets/img/ppb_logo.png', FALSE); ?> </a>
                        </div>
                   
                    
                    <ul class="sidebar-menu">
						<li> 
                       Welcome to PPB-KPA Online  
						</li>
						<li> 
                       PPB HOME 
						</li>
						
                    </ul>
                </section>
                
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            
            <aside class="right-side">
            	<section class="content-header">
                    <h1>
                        General Form Elements
                        <small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="#">KPA</a></li>
                        <li class="active">Login</li>
                    </ol>
            </section>
            
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        LOGIN 
                        <small>to PPB-KPA</small>                    </h1>
              </section>
			<?php echo br(2); ?>
                <!-- Main content -->
                 <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading"> 					
						<?php echo validation_errors(); ?>
                        <h3 class="panel-title">Please Sign In</h3>
                    	<?php echo form_open('main/login_proc'); ?>
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
												'name' => 'enrollmentNumber', 
												'type' => 'text',
												'autofocus' => 'true',
												'placeholder' => 'Enrollment No. /KPA No',
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
								
								echo form_label("Enrollment/KPA No.")." (New Member? ". anchor_popup('main/register_user', 'Register', $attributes).")" ;
								// echo form_label("Enrollment/KPA No."). anchor_popup('main/register_user', 'Register Here', $attributes);
								 echo form_input($data);
								 echo "</div>";
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
                <?php echo br(4); ?>
				<div class="footer-panel panel panel-default">
							<div>												
								<h6 align="center"> &copy <?php echo date("Y") . " All Rights Reserved" ;?>
								<br /> KENYA PHARMACEUTICAL ASSOCIATION 	</h6> 
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