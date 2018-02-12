<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>
<style>
<!--
.lbl-arabic{
 	font-family: "Tahoma";
 }
-->
</style>
<?php  
	   echo form_open('employee/update',array('id'=>'mainForm', 'enctype'=>"multipart/form-data"));
	   echo form_hidden("employee_id",$form->employee_id);
?>
<div class="tabbable tabbable-custom boxless">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs_0" data-toggle="tab">Personal Information</a></li>
		<li><a href="#tabs_1" data-toggle="tab">Academic Details</a></li>
		<li><a href="#tabs_2" data-toggle="tab">Experience Details</a></li>
		<li><a href="#tabs_3" data-toggle="tab">Other Details</a></li>
		<li><a href="#tabs_4" data-toggle="tab">GOSI</a></li>
		<li><a href="#tabs_5" data-toggle="tab">HRDF(Mawarid)</a></li>
		<li><a href="#tabs_6" data-toggle="tab">Documents & Files</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabs_0"><?php include "edit_personal_detail.php"?></div>
		<div class="tab-pane " id="tabs_1" ><?php include "edit_academic_details.php"?></div>
		<div class="tab-pane " id="tabs_2" ><?php include "edit_experience_details.php"?></div>
		<div class="tab-pane " id="tabs_3" ><?php include "edit_other_details.php"?></div>
		<div class="tab-pane " id="tabs_4" style="height: 420px"><?php include "edit_gosi.php"?></div>
		<div class="tab-pane " id="tabs_5" style="height: 420px"><?php include "edit_hrdf.php"?></div>
		<div class="tab-pane " id="tabs_6"><?php include "edit_attached_files.php"?></div>
	</div>
</div>

<script src="<?php echo base_url();?>assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
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
		});

		function setAllCheckOptions(){
			var obj = document.getElementById('checkall');
	        if(obj.checked){
	        	for(a=1;a<=8;a++){
					document.getElementById('option0'+a).checked = true;
					$('input#option0'+a).closest('span').addClass('checked');
				}
	        }
	        else{
	        	for(a=1;a<=8;a++){
					document.getElementById('option0'+a).checked = false;
					$('input#option0'+a).closest('span').removeClass('checked');
				}
	        }	
		}

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