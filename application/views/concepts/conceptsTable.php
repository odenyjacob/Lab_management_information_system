<?php /*
	if($access['timecardApproval']!='yes'){
		redirect('main/unauthorized');
	}
 * 
 */
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

<!-- Validation Engine -->
   <link href="<?= base_url('/public/css/validation/validationEngine.jquery.css'); ?>" type="text/css" rel="stylesheet" />   
   <script type="text/javascript" src="<?= base_url('/public/js/validation/jquery.validationEngine-en.js'); ?>"></script>
   <script type="text/javascript" src="<?= base_url('/public/js/validation/jquery.validationEngine.js'); ?>"></script>

<script type="text/javascript" src="<?= base_url('public/fancybox/jquery.fancybox.js?v=2.1.5'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url('public/fancybox/jquery.fancybox.css?v=2.1.5'); ?>" media="screen" />
<style>
.zoom{
	transition: all .2s ease-in-out;
}
.zoom:hover{
	text-decoration:overline;
	text-transform: uppercase;
	color: red;
}


.deleteRecord{
        cursor: pointer;
    }
</style>

<script type="text/javascript">
	$(document).ready(function(){
    	$(document).on("contextmenu", function(){    		
    		alert("Action disabled by the developer on this page!");
    		return false;
    	});
    }); 
</script>

</head>
<body>
	<div id="page-wrapper">	
		<div class="row">
			<div class="col-md-12 col-md-offset-0">				
				<div class="<?php echo $this->session->userdata('panel'); ?>">
			  		<div class="panel-heading">
			    		<h3 class="panel-title" align="center"> :::: CONCEPTS FOR THE TABLES :::</h3>  
			  		</div>
			  		<div class="panel-body"> 
			  			
		<h2><hr /> Concepts Table <hr /> </h2>
        <div id="dynamic">

            <a class="various " data-fancybox-type="iframe" href="<?= base_url() ?>index.php/concepts/popupadd/">Add new Concepts</a>
            <br/>
            <div style="overflow-x: scroll; height: 100%; ">
            <!-- start data table here-->
            <table cellpadding="0" cellspacing="0" class="displayGrid" id="dealList"  style="width: 100% ">
                <thead>
                    <tr>
                        <th width="60px" >id</th>
                        <th>table name</th>
                        <th width="25%" >objective</th>
                        <th>measure</th>
                        <th>reporting schedule</th>
                        <th>methodology numerator</th>
                        <th>methodology denominator</th>
                        <th>methodology multiplier</th>
                        <th>username</th>
                        <th>insert/update time</th>
                        <th width="60px">edit</th>
                        <th width="60px">delete</th>
                    </tr>
                </thead>
                <tbody>	
                </tbody>
            </table>
            <br />
            </div>
            <!--end datatable--> 
			 </div> 			
			  			<?php echo br(3); ?>
					</div> <!--End of PB -->
				
		       </div>
			   <?php echo br(3); ?>
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
                "sAjaxSource": "<?= base_url('index.php/concepts/getConceptsTable'); ?>",
                "aoColumns": [
                    {"mDataProp": "concepts_id"},
                    {"mDataProp": "table_name"},
                    {"mDataProp": "objective"},
                    {"mDataProp": "measure"},
                    {"mDataProp": "reporting_schedule"},
                    {"mDataProp": "methodology_numerator"},
                    {"mDataProp": "methodology_denominator"},
                    {"mDataProp": "methodology_multiplier"},
                    {"mDataProp": "userName"},
                    {"mDataProp": "timeStamp"},
                    {"mDataProp": "edit"},
                    {"mDataProp": "delete"}
                ],
                "aoColumnDefs": [
                    {"bSortable": false, "aTargets": [9]},
                    {"bSortable": false, "aTargets": [10]}
                ],
                "aaSorting": [[0, "desc"]]
            });
        });
        function deleteRecord(id) {
                var r = confirm("Are You Sure Delete Records?");
                if (r === true) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('index.php/concepts/deleteConcepts'); ?>",
                        data: {summaries_id: id},
                        beforeSend: function() {
                            $('#wait').html("Wait for checking");
                        },
                        success: function(resp) {
                            var obj = jQuery.parseJSON(resp);
                            if (obj.success === 1) {
                                $('#errorMessage').show();
                                $(".msgDisplay").html(obj.msg);                                
                                alert('Deleted Successfully!');
                            } else {
                                $('#errorMessage').show();
                                $(".msgDisplay").html(obj.msg);                                
                                alert('Error:  Try Again!');
                            }
                            oTable.fnDraw();
                        }
                    });
                }
            }
    </script>
    <script>


        function editFancybox() {
            
            $.fancybox({
                maxWidth: 800,
                maxHeight: 600,
                fitToView: true,
                
                width: '70%',
                height: '70%',
                autoSize: true,
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
                autoSize: true,
                closeClick: false,
                openEffect: 'none',
                closeEffect: 'none',
                beforeClose: function() {
                    oTable.fnDraw();
                }
            });
        });

    </script>

</html>