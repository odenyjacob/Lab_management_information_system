<?php $username = $this->session->userdata('userName');
$location = $this->session->userdata('location');
if(empty($username)){
redirect(base_url());
exit;
}
?> 

<!DOCTYPE html>
<html lang="en">   
<head>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <meta name="description" content="">
    <meta name="author" content="">
	
	<!--	<title></title> -->
     

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('dashboard/css/bootstrap.min.css') ?>" rel="stylesheet">  

    <!-- MetisMenu CSS -->
     <link href="<?php echo base_url('dashboard/css/plugins/metisMenu/metisMenu.min.css') ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('dashboard/css/sb-admin-2.css') ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href=<?php echo base_url('dashboard/font-awesome-4.1.0/css/font-awesome.min.css') ?> rel="stylesheet">
    <link href=<?php echo base_url('dashboard/font-awesome-4.4.0/css/font-awesome.min.css') ?> rel="stylesheet">
    <?php $navbar = $this->session->userdata('navbar'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style type="text/css">
	.zoom{
		transition: all .2s ease-in-out;
	}
	.zoom:hover{
		transform: scale(1.2);
	}   

</style> 	


</head> 

<body>

    
        <!-- Navigation -->
        <nav class="navbar <?php echo $navbar ?> navbar-static-top" role="navigation" >
        <div id="wrapper">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand header" href="<?php echo site_url('main/home');?>"><i class="fa fa-home"></i> HIVR LAB MANAGEMENT INFORMATION SYSTEM </a> 
		    </div>
		     <?php $role = $this->session->userdata('role');?>
		     <?php $FName = $this->session->userdata('FName');?>
		     <?php $LName = $this->session->userdata('LName');?>
		  <!--  Collect the nav links, forms, and other content for toggling 
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		   
		      </div>-->
		       <?php $username = $this->session->userdata('username');
		       $location = $this->session->userdata('location');
		       ?>
		      <ul class="nav navbar-nav navbar-right collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      	<!--
		      	<li class="dropdown ">
		          <a  href="<?php echo  site_url('scm/notifications');?>" class="zoom fa fa-comment fa"> <i class=" fa <?php echo $this->session->userdata('label'); ?>" > <?php if($access['stocking']=true){echo "*";}?> </i> </a>
		       </li> -->
		        		<li class="dropdown">		        	
		        <a href="#" class="dropdown-toggle zoom fa fa-gear" data-toggle="dropdown"> Change Theme<span class="caret"></span></a>  
		          <ul class="dropdown-menu" role="menu">
			    <li><a href="<?php echo site_url('main/changeprimary');?>">Primay</a></li>			   
		            <li class="divider"></li> 
		            <li><a href="<?php echo site_url('main/changedefault');?>">Default</a></li> 			     
		            <li class="divider"></li> 
		            <li><a href="<?php echo site_url('main/changedanger');?>">Danger</a></li> 			     
		            <li class="divider"></li> 
		            <li><a href="<?php echo site_url('main/changesuccess');?>">Success</a></li> 
		            <li class="divider"></li> 
		            <li><a href="<?php echo site_url('main/changeinfo');?>">Info</a></li> 
		           <!-- <li><a href="<?php echo site_url('main/changewarning');?>">Warning</a></li> This is reserved for displaying warning! -->
					<!--		     
		            <li class="divider"></li> 
		            <li><a href="<?php echo site_url('main/changefade');?>">Fade</a></li> 	
		           -->		      
		        </ul>  
		        </li>
		       <?php if($access['user_access']==='yes'){ ?>	
		      	<li class="dropdown">		        	
		        <a href="#" class="dropdown-toggle zoom fa fa-users" data-toggle="dropdown"> User Groups<span class="caret"></span></a>  
		          <ul class="dropdown-menu" role="menu">
			    <li><a href="<?php echo site_url('main/user_access');?>">Manage Access Levels</a></li>			   
		            <li class="divider"></li> 
		        </ul>  
		        </li>
		      <?php } ?>
		        
		      	<li class="dropdown ">
		          <a href="<?php echo site_url('main/user_profile');?>" class="zoom fa fa-user"><?php echo " $FName $LName"  ?> </a>
		        </li>		        
		      	<li class="dropdown ">
		          <a href="#" class="zoom fa fa-bullseye"><?php echo " $location"  ?> </a>
		        </li>		        
		      	
		       <li class="dropdown">		        	
		        <a href="#" class="dropdown-toggle zoom fa fa-gears" data-toggle="dropdown"> Options<span class="caret"></span></a>
		          <ul class="dropdown-menu" role="menu">
			    <li><a href="<?php echo site_url('main/changePassword');?>"><i class="fa fa-refresh fa-fw"></i>Change Password</a></li>
			   <?php if($role=="Administrator")   {  ?>
		            <li class="divider"></li> 
		            
			    <?php } ?>  
			    <?php if($access['addEmployee']==='yes'){ ?>
			       						
								<li>
                                    <a href="<?php echo site_url('hcm/newEmployee');?>"><i class="fa fa-male fa-fw"></i>Add User</a> 
                                </li>
                                		
			    <?php } ?>	 
		        </ul>  
		        </li>
		       
		        <li class="dropdown ">
		        <a href="<?php echo site_url('main/logout');?>" class="fa fa-power-off zoom"> </a>
		        </li>
		       
		        
		      </ul>
		    </div><!-- /.navbar-collapse --> 
 			</div><!-- /.container-fluid -->
            <!-- /.navbar-top-links -->
			
            <div class="navbar sidebar" role="navigation">
	<!--		 <a href="#"> <?php echo img('assets/img/logo.png', FALSE); ?> </a>  //Image Logo -->
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
					
					
                        <li class="sidebar-search">
                        	<?php echo form_open(); ?>
                            <div class="input-group custom-search-form">                            	
                                <input type="text" class="form-control" placeholder="Search..." name="search">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="searchPatient"> 
                                    <i class="fa fa-search"></i>
                                </button>
                                <?php echo form_close(); ?>
                            </span>
                            </div>
                            
                        </li>
                       <?php if($access['addEmployee']==='value'){ ?>	
                       	
                       <?php } ?>
                                               
                       <li>
                            <a href=""><i class=" fa fa-users fa-fw"></i> ADMINISTRATION <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">                        
                                 
                                <li>   
                                    <a href="<?php echo site_url('users/users');?>">Users</a> 
                                </li>   

                                <li>   
                                    <a href="<?php echo site_url('centers/centersTable');?>">Centers</a> 
                                </li> 

                                <li>   
                                    <a href="<?php echo site_url('centers/branchesTable');?>">Branches</a> 
                                </li>   

                                <li>   
                                    <a href="<?php echo site_url('projects/projectsTable');?>">Projects</a> 
                                </li>   

                                <li>   
                                    <a href="<?php echo site_url('samples/sampleTypesTable');?>">Sample Types</a> 
                                </li>                                                                                
                                <li>   
                                    <a href="<?php echo site_url('storages/storagesTable');?>">Storages</a> 
                                </li>                                                                                
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                                               
                       <li>
                            <a href=""><i class=" fa fa-close fa-fw"></i> SAMPLES<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level"> 
                                <li>   
                                    <a href="<?php echo site_url('samples/samples');?>">New Samples</a> 
                                </li>   

                                <li>   
                                    <a href="<?php echo site_url('samples/receive');?>">Receive Samples</a> 
                                </li>   

                                <li>   
                                    <a href="<?php echo site_url('samples/received');?>">Received Samples</a> 
                                </li>   
                                                    
                                <li>   
                                    <a href="<?php echo site_url('samples/samples');?>">All Samples</a> 
                                </li>                                                               
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                       <li>
                            <a href=""><i class=" fa fa-close fa-fw"></i> SAMPLE REJECTION<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level"> 
                                <li>   
                                    <a href="<?php echo site_url('samples/rejectionTable');?>">Rejection Table</a> 
                                </li>                       
                                                             
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                      
                        <li>
                            <a href=""><i class=" fa fa-edit fa-fw"></i> INTERNAL QC <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level"> 
                                <li>   
                                    <a href="<?php echo site_url('iqc/iqcTable');?>">Internal QC Table</a> 
                                </li>                       
                                                             
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href=""><i class=" fa fa-user-md fa-fw"></i> CRITICAL VALUE REP. <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level"> 
                                <li>   
                                    <a href="<?php echo site_url('cvr/cvrTable');?>">CVR  Table</a> 
                                </li>                       
                                                             
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                          
                       <li>
                            <a href=""><i class=" fa fa-flask fa-fw"></i> EQA CHEMISTRY<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level"> 
                                <li>   
                                    <a href="<?php echo site_url('eqa/eqaTable');?>">EQA Chemistry Table</a> 
                                </li>                       
                                                             
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                            <a href=""><i class=" fa fa-flask fa-fw"></i> EQA URINALYSIS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level"> 
                                <li>   
                                    <a href="<?php echo site_url('urinalysis/urinalysisTable');?>">EQA Urinalysis Table</a> 
                                </li>                       
                                                             
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                            <a href=""><i class=" fa fa-flask fa-fw"></i> EQA HEMATOLOGY<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level"> 
                                <li>   
                                    <a href="<?php echo site_url('hematology/hematologyTable');?>">EQA Hematology Table</a> 
                                </li>                       
                                                             
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                            <a href=""><i class=" fa fa-flask fa-fw"></i> EQA ELISA MARKERS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level"> 
                                <li>   
                                    <a href="<?php echo site_url('elisa/elisaTable');?>"><i class=" fa fa-flask fa-fw"></i>EQA Elisa Markers Table</a> 
                                </li>                       
                                                             
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                            <a href=""><i class=" fa fa-flask fa-fw"></i> EQA RAPID HIV & OTHERS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level"> 
                                <li>   
                                    <a href="<?php echo site_url('rapidHiv/rapidHivTable');?>">Rapid HIV & Others Table</a> 
                                </li>                       
                                                             
                                
                            </ul>
                            <!-- /.nav-second-level -->
                       </li> 
                       <li>
                            <a href=""><i class=" fa fa-stethoscope fa-fw"></i> BC, PARASITES & CTNG<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level"> 
                                <li>   
                                    <a href="<?php echo site_url('bc/bcTable');?>">BC, Parasites & CTNG Table</a> 
                                </li>                       
                                                             
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                            <a href=""><i class=" fa fa-edit fa-fw"></i> TAT<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level"> 
								
                                <li>   
                                    <a href="<?php echo site_url('tat/tatTable');?>">TAT Table</a> 
                                </li>                       
                                                             
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                     
                       <li>
                            <a href=""><i class=" fa fa-users fa-fw"></i> CUSTOMER SATISFACTION<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level"> 
								
                                <li>   
                                    <a href="<?php echo site_url('satisfaction/satisfactionTable');?>">Customer Satisfaction Table</a> 
                                </li>                       
                                                             
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>    
                                         
                       <li>
                            <a href=""><i class=" fa fa-cog fa-fw"></i> EXTRAS: CONFIGURATIONS<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level"> 
								
                                <li>   
                                    <a href="<?php echo site_url('summaries/summariesTable');?>">Summaries Table</a> 
                                </li>                       
                                <li>   
                                    <a href="<?php echo site_url('concepts/conceptsTable');?>">Table of Concepts</a> 
                                </li>                       
                                                             
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                     
                  
                                 
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
		<br />
        <!-- Page Content -->
        
        <!-- /#page-wrapper -->

 
    	<!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url('dashboard/js/jquery-1.11.0.js') ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('dashboard/js/bootstrap.min.js') ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
   <script src="<?php echo base_url('dashboard/js/plugins/metisMenu/metisMenu.min.js') ?>"></script>

    <!-- Custom Theme JavaScript -->
   <script src="<?php echo base_url('dashboard/js/sb-admin-2.js') ?>"></script>

</body>

<script type="text/javascript">
$(document).ready(function(){
	$('.dropdown-toggle').dropdown();
});
	 
	
</script>


</html>

