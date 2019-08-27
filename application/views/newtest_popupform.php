<?php
/*
	if($access['timecardApproval']!='yes'){
		redirect('main/unauthorized');
	} */
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

<script type="text/javascript" src="<?= base_url('public/fancybox/jquery.fancybox.js?v=2.1.5'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url('public/fancybox/jquery.fancybox.css?v=2.1.5'); ?>" media="screen" />
   
 <style>
    .deleteRecord{
        cursor: pointer;
    }

    .menu {font-family: arial, sans-serif; width:750px; height:30px; position:relative; font-size:16px; z-index:100;}
    .menu ul li a, .menu ul li a:visited {display:block; text-decoration:none; color:#000;width:104px; height:20px; text-align:center; color:#fff; border:1px solid #fff; background:#710069; line-height:20px; font-size:11px; overflow:hidden;}
    .menu ul {padding:0; margin:0; list-style: none;}
    .menu ul li {float:left; position:relative;}
    .menu ul li ul {display: none;}

    /* specific to non IE browsers */
    .menu ul li:hover a {color:#fff; background:#36f;}
    .menu ul li:hover ul {display:block; position:absolute; top:21px; left:0; width:105px;}
    .menu ul li:hover ul li a.hide {background:#6a3; color:#fff;}
    .menu ul li:hover ul li:hover a.hide {background:#6fc; color:#000;}
    .menu ul li:hover ul li ul {display: none;}
    .menu ul li:hover ul li a {display:block; background:#ddd; color:#000;}
    .menu ul li:hover ul li a:hover {background:#6fc; color:#000;}
    .menu ul li:hover ul li:hover ul {display:block; position:absolute; left:105px; top:0;}
    .menu ul li:hover ul li:hover ul.left {left:-105px;}

    .menu ul li a.active {color:#fff; background:#36f;}

    
</style>
<script>
    function menuSelect(menu) {
        $(function() {
            $('#' + menu).addClass('active');
        });
    }
    
</script>  


</head>
<body>
	<div id="page-wrapper">	
		<div class="row">
			<div class="col-md-12 col-md-offset-0">				
				<div class="<?php echo $this->session->userdata('panel'); ?>">
			  		<div class="panel-heading">
			    		<h3 class="panel-title" align="center"><?= $this->customerid != NULL ? 'UPDATE TEST' : 'ADD NEW TEST'; ?></h3>  
			  		</div>
			  		<div class="panel-body"> 
		    <h1>customers form</h1> 
    <div id="body">

        <form id="formID" action="<?= base_url('index.php/scm/customerprocess/'); ?>" method="post"  name="newproject" enctype="multipart/form-data">
            <input type="hidden" name="type" value="<?= $this->customerid != NULL ? 'updateTest' : 'addTest'; ?>" />
            <input type="hidden" name="popup" value="true"/>
            <input type="hidden" name="customerid" value="<?= $this->customerid; ?>"/>
            <table>
                <tr>
                    <td>Test</td>
                    <td><input class="validate[required] form-control" id="test"  name="test" type="text" value="<?= $this->test; ?>"/></td>
                </tr>
                <tr>
                    <td>Customer's  Phone</td>
                    <td><input class="validate[required]" id="customerphone"  name="customerphone" type="text" value="<?= $this->customerphone; ?>"/></td>
                </tr>
                <tr>
                    <td>Customer's  Address</td>
                    <td><input class="validate[required]" id="customeraddress"  name="customeraddress" type="text" value="<?= $this->customeraddress; ?>"/></td>
                </tr>
                <tr>
                    <td>Customer's  Location</td>
                    <td><input class="validate[required]" id="customerlocation"  name="customerlocation" type="text" value="<?= $this->customerlocation; ?>"/></td>
                </tr>
                <tr>
                    <td>Customer's  Email</td>
                    <td><input class="validate[required]" id="customeremail"  name="customeremail" type="text" value="<?= $this->customeremail; ?>"/></td>
                </tr>
                <tr>
                    <td>
                        
                        <input type="button" onclick="save()" value="submit" name="submit" /> 
                        
                    </td>
                    <td><a href="<?= base_url('index.php/scm/customers'); ?>">cancel</a></td>
                </tr>
            </table>
        </form>
        
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
    <script>
        $.fx.speeds._default = 1000;
        var oTable;
        $(document).ready(function() {
            oTable = $('#dealList').dataTable({
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "bProcessing": true,
                "bServerSide": true,
                "bRedraw": true,
                "sAjaxSource": "<?= base_url('index.php/scm/dataTable'); ?>",
                "aoColumns": [
                    {"mDataProp": "brands_id"},
                    {"mDataProp": "brands_name"},
                    {"mDataProp": "edit"},
                    {"mDataProp": "delete"}
                ],
                "aoColumnDefs": [
                    {"bSortable": false, "aTargets": [2]},
                    {"bSortable": false, "aTargets": [3]}
                ],
                "aaSorting": [[0, "desc"]]
            });
        });
        function deleteRecord(id) {
            var r = confirm("Are You Sure Delete Records?");
            if (r === true) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('index.php/brands/delete'); ?>",
                    data: {brands_id: id},
                    beforeSend: function() {
                        //$('#wait').html("Wait for checking");
                    },
                    success: function(resp) {

                        var obj = jQuery.parseJSON(resp);
                        if (obj.success === 1) {
                            $('#errorMessage').show();
                            $(".msgDisplay").html(obj.msg);
                        } else {
                            $('#errorMessage').show();
                            $(".msgDisplay").html(obj.msg);
                        }
                        oTable.fnDraw();
                    }
                });
            } else {
            }
        }

        //this function for menu selecting
        menuSelect("menuBrands");
    </script>
    <script>


        function editFancybox() {
            
            $.fancybox({
                maxWidth: 800,
                maxHeight: 600,
                fitToView: false,
                
                width: '70%',
                height: '70%',
                autoSize: false,
                closeClick: false,
                openEffect: 'none',
                closeEffect: 'none',
                beforeClose: function() {
                    oTable.fnDraw();
                }
            });
        }





        $(function() {
            //pop up box configuration



            $(".various").fancybox({ 
                maxWidth: 800,
                maxHeight: 600,
                fitToView: false,
                width: '70%',
                height: '70%',
                autoSize: false,
                closeClick: false,
                openEffect: 'none',
                closeEffect: 'none',
                beforeClose: function() {
                    oTable.fnDraw();
                }
            });
        });

    </script>
    
    <script>
        $(document).ready(function() {
            $("#formID").validationEngine();
        });
        //this function for menu selecting
        menuSelect("menuBrands");
        
        
        function save() {
            
            var validate =  $('#formID').validationEngine("validate");
            if(!validate){
                return false;
            }
            var submit = $('#formID').serialize();
            $.ajax({
                type: "POST",
                url: "<?= base_url('index.php/scm/customerprocess/'); ?>",
                data: submit,
                beforeSend: function() {
                },
                success: function(resp) {
                    var response = jQuery.parseJSON(resp);
                    
                    parent.$.fancybox.close();
                },
                error: function(e) {
                }
            });
        }
        
        
    </script>


</html>