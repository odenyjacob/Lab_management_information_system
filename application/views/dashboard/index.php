<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Premaquine Study - Dashboard</title>       
        
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url('assets/dashboard/css/bootstrap.min.css') ?>" rel="stylesheet">
        
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
               Premaquine Study
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
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Admin <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="../agent/img/logo.png" class="img-circle" alt="User Image" />
                                    <p>
                                        Admin
                                    </p>
                                </li>     
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="../agent/logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>                           
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas" style="position: fixed;">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Admin</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <?php echo anchor('main/success', '<i class="fa fa-dashboard"></i> Home'); ?>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Surveys</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><?php echo anchor('main/show_all_surveys', '<i class="fa fa-angle-double-right"></i> All Surveys'); ?></li>
                            </ul>
                        </li>                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
            	<section class="content-header">
                    <h1>
                        General Form Elements
                        <small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Forms</a></li>
                        <li class="active">General Elements</li>
                    </ol>
            </section>
            
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Home Page
                        <small>Premaquine Study</small>                    </h1>
              </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Main row -->
                    <div class="row">
                       <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        150
                                    </h3>
                                    <p>
                                        Total Surveys
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        53
                                    </h3>
                                    <p>
                                        3/4 Complete Surveys
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        44
                                    </h3>
                                    <p>
                                        Half Complete Surveys
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        65
                                    </h3>
                                    <p>
                                        Uncompleted Surveys
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row (main row) -->
                    <hr/>
                    
                    <div class="row">
                    	<!-- Left col -->
                        <section class="col-lg-7 connectedSortable"> 
                        	<!-- Map box -->
                            <div class="box box-solid bg-light-blue-gradient">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range"><i class="fa fa-calendar"></i></button>
                                        <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                                    </div><!-- /. tools -->

                                    <i class="fa fa-map-marker"></i>
                                    <h3 class="box-title">
                                        Survey Map
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <div id="world-map" style="height: 250px;"></div>
                                </div><!-- /.box-body-->
                                <div class="box-footer no-border">
                                    <div class="row">
                                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                            <div id="sparkline-1"></div>
                                            <div class="knob-label">Active Areas</div>
                                        </div><!-- ./col -->
                                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                           <div id="sparkline-2"></div>
                                            <div class="knob-label">Ongoing Areas</div>
                                        </div><!-- ./col -->
                                        <div class="col-xs-4 text-center">
                                            <div id="sparkline-3"></div>
                                            <div class="knob-label">Inactive Areas</div>
                                        </div><!-- ./col -->
                                    </div><!-- /.row -->
                                </div>
                            </div>
                            <!-- /.box -->
                        </section>
                    </div>
                    
                </section><!-- /.content -->
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