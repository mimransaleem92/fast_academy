<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>
<style>
<!--
.lbl-arabic{
 	font-family: "Tahoma";
 }
-->
</style>
<?php if(isset($_GET['msg']) && $_GET['msg'] == '1'){?>
<div class="alert alert-success">
	<button class="close" data-close="alert"></button>
	<div id="error1">Your information successfully saved!!</div>
</div>
<?php }else{?>
<?php echo form_open('employee/add',array('id'=>'mainForm', 'enctype'=>"multipart/form-data")); ?>
<div class="tabbable tabbable-custom boxless">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs_0" data-toggle="tab">Personal Information</a></li>
		<li><a href="#tabs_1" data-toggle="tab">Academic Details</a></li>
		<li><a href="#tabs_2" data-toggle="tab">Experience Details</a></li>
		<?php //if($admin_role >= 1){ ?>
		<li><a href="#tabs_3" data-toggle="tab">Other Details</a></li>
		<?php //} ?>
		<li><a href="#tabs_4" data-toggle="tab">GOSI</a></li>
		<li><a href="#tabs_5" data-toggle="tab">HRDF(Mawarid)</a></li>
	</ul>
	<div class="tab-content">
		<?php //echo form_open('employee/add',array('id'=>'mainForm', 'class'=>"form-horizontal")); ?>
		<div class="tab-pane active" id="tabs_0"><?php include "personal_detail.php"?></div>
		<div class="tab-pane " id="tabs_1" ><?php include "academic_details.php"?></div>
		<div class="tab-pane " id="tabs_2" ><?php include "experience_details.php"?></div>
		<div class="tab-pane " id="tabs_3" style=""><?php include "other_details.php"?></div>
		<div class="tab-pane " id="tabs_4" style="height: 420px"><?php include "gosi.php"?></div>
		<div class="tab-pane " id="tabs_5" style="height: 420px"><?php include "hrdf.php"?></div>
		
	</div>
</div>
<?php echo form_close();
} ?>
<!-- END FORM-->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script>
		jQuery(document).ready(function() {
			App.init();	
			if (jQuery().datepicker) {
	           $('.date-picker').datepicker({
	           	dateFormat: "dd-mm-yy",
	               rtl: App.isRTL(),
	               autoclose: true
	           });
	           $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
	       }
			//$('body').removeClass('');
			$('body .page-container > div').removeClass('');
           	$('body .page-container > div').addClass('page-sidebar-hide');
		});

		for(r=5; r<=10; r++){
      	  document.getElementById('exp_row_'+r).style.display = "none";
        }

		var totalsizeOfUploadFiles = 0;
	    function getFileSizeandName(input)
	    {
	        var select = $('#uploadTable');
	        for(var i =0; i<input.files.length; i++)
	        {           
	            var filesizeInBytes = input.files[i].size;
	            var filesizeInMB = (filesizeInBytes / (1024*1024)).toFixed(2);
	            var filename = input.files[i].name;
	            
	            totalsizeOfUploadFiles += parseFloat(filesizeInMB);
	            $('#totalsize').text("Size: " + totalsizeOfUploadFiles.toFixed(2)+" MB");
	            if(i==0)
	                $('#filecount').text("1 file selected");
	            else
	            {
	                var no = parseInt(i) + 1;
	                $('#filecount').text(no+" files selected");
	            }
	        }           
	    }
	        
		function showExpRow() {
			var i = document.getElementById('exp_row_added').value ;
			if(i < 10){
				i++;
				document.getElementById('exp_row_added').value = i;
				document.getElementById('exp_row_'+i).style.display = "table-row";
			}
		}

		for(r=5; r<=10; r++){
      	  document.getElementById('academic_row_'+r).style.display = "none";
        }
        
		function showAcademicRow() {
			var i = document.getElementById('academic_row_added').value ;
			if(i < 10){
				i++;
				document.getElementById('academic_row_added').value = i;
				document.getElementById('academic_row_'+i).style.display = "table-row";
			}
		}
</script>