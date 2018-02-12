<link type="text/css" href="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js"></script>
<style>
<!--
.noclose .ui-dialog-titlebar-close
{
    display:none;
}
-->
</style>		<?php $student = $student_list[0]; ?>
				<form id="marksheetForm" method="post" >
					<div class="form-body">
						<div class="row alert alert-success">
							<div class="col-md-6">
								<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Course Name').' / '.Base_Controller::ToggleLang('Section');?></label>
								<?php
								$c = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
								$sec = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
								$admin_user = ($this->session->userdata(SESSION_CONST_PRE.'role_id') == 1) ? true : false;
								?>
								<div class="col-md-7">
									<div class="form-group">
	    								<?php
	    								if($admin_user){
	    									echo '<select name="course_id" class="form-control col-md-6" id="course_id" style="width: 150px" onchange="marksheetForm.submit();" >';
	    									foreach($courses_list as $course){
												$course_id = $course->course_id;
												$sel = ($course_id ==  $c) ?  'selected' : '' ;
												echo '<option value="'.$course_id.'" '.$sel.'>'.$course->course_name.'</option>';
											}
											echo '</select>';
											echo '<input type="text" name="section" class="form-control col-md-4" id="section" value="'.$sec.'" style="width: 50px">';
										}else{
											foreach($courses_list as $course){
												$course_id = $course->course_id;
												if($course_id ==  $c) { $course_name = $course->course_name; break;}
											}
										?>
    									<input type="hidden" name="course_id" id="course_id" value="<?php echo $c; ?>">
    									<input type="text" name="course_name" readonly="readonly" class="form-control col-md-6" id="course_name" value="<?php echo $course_name; ?>" style="width: 150px">
    									<input type="text" name="section" readonly="readonly" class="form-control col-md-4" id="section" value="<?php echo $sec; ?>" style="width: 50px">
    									<?php }?>
    								</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3 right"><?php echo Base_Controller::ToggleLang('Student #');?></label>
									<div class="col-md-5" >
										<input type="text" name="admission_number" class="form-control col-md-4" id="admission_number" value="<?php if(isset($_POST['admission_number'])) echo $_POST['admission_number']; ?>" placeholder="VIS-16-0000"  style="width: 150px" onkeyup="onkeyup_student(this, event)">
									</div>
									<div class="col-md-4" >
										<!-- 
										<a class="btn green" href="<?php echo base_url().$model.'/print_view/?admission_number='.$student->admission_number;?>" target="_blank"><i class="fa fa-print"></i> Print</a>
										-->
										<a class="btn green" href="<?php echo base_url().$model.'/print_all/?course_id='.$c.'&section='.$sec;?>" target="_blank"><i class="fa fa-print"></i> Print All</a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row alert alert-info cl-md-12" id="tbl_marksheet" >
					 		<table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
					 				<tr style="font-size: 1.1em; font-weight: bold;">
					                	<td style="text-align: center;"><?php echo Base_Controller::ToggleLang('No');?></td>
					                	<td style="padding-left: 4px; " ><?php echo Base_Controller::ToggleLang('Admission #');?></td>
					                	<td style="padding-left: 4px; " ><?php echo Base_Controller::ToggleLang('Student Name');?></td>
					                	<td style="padding-left: 4px; " ><?php echo Base_Controller::ToggleLang('Course').' & '.Base_Controller::ToggleLang('Session');?></td>
					                	<td style="text-align: center;" ><?php echo Base_Controller::ToggleLang('Semester1');?></td>
										<td style="text-align: center;" ><?php echo Base_Controller::ToggleLang('Semester2');?></td>
					                	<td style="text-align: center;" ><?php echo Base_Controller::ToggleLang('GPA');?></td>
					                	<td style="text-align: center;" ><?php echo Base_Controller::ToggleLang('Grade');?></td>
					                	<td></td>
					                </tr>	
					               	<?php $i = 0;
				                	if(isset($student_list) && sizeof($student_list)>0)
				                	{
			                    		 foreach ($student_list as $row)
			                    		 { $i++;
			                    		   $average_marks = ($subject_count > 0) ? $row->obtain_marks / $subject_count : '0'; 
			                    	?>
				                    <tr>
			                			<td style="text-align: center;"><?php echo $i;?></td>
			                			<td style="padding-left: 4px"><?php echo $row->admission_number;?></td>
			                			<td style="padding-left: 4px; padding-right: 4px"><?php echo $row->student_name;?></td>
			                			<td style="padding-left: 4px"><?php echo $row->course_name . ' '. $row->section . ' & '. $row->batch_name;?></td>
			                			<td style="text-align: center;"><?php echo number_format($row->obtain_marks, 2);?></td>
										<td style="text-align: center;"><?php echo isset($semester2[$row->student_id]) ? number_format($semester2[$row->student_id]['obtain_marks'], 2) : '0';?></td>
			                			<td style="text-align: center;"><?php echo Util::final_gpa($average_marks);?></td>
			                			<td style="text-align: center;"><?php echo Util::final_grade($average_marks);?></td>
			                			<td style="text-align: center;"><a class="btn default btn-xs green-stripe" href="#" onclick="window.open('<?php echo base_url()."final_report/print_view/".$row->student_id;?>', '_blank')">View</a></td>
			                		</tr>	
				                    <?php }
				                    } ?>
				        	</table>	
					 	</div>
				 	</div>
					 	
			</form>
	        <input type="hidden" id="count" value="0"/>
	        <div id="dialog-form"></div>
	        
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>	
<script> 
		jQuery(document).ready(function() {    
		   // initiate layout and plugins
		   App.init();
		});

	        function onchange_courses(val){
		        if(val != ''){
			        
	        		get('<?php echo base_url().'timetable/batches/';?>'+val, '', 'td_batch','false','');
		        }
	        }

	        function remove_attendance(val, id){
	        	get('<?php echo base_url().$model.'/add_attendance?';?>'+val, '', id, false,'');
	        }
	        
	        function get_back(){
	        	var w = document.getElementById('week').value;
	        	if(w > 2){
		        	document.getElementById('week').value = --w;
		        	attendanceForm.submit();
	        	}
	        }

	        function get_next(){
	        	var w = document.getElementById('week').value;
	        	if(w < 19){
	        		document.getElementById('week').value = ++w;
	        		attendanceForm.submit();
	        	}
	        }
	        
			function showUrlInDialog(_url, params, options, cell_id){
            	options = options || {};
            	var tag = $("#dialog-form"); //This tag will hold the dialog content.
            	$.ajax({
            	    url: _url+'?'+params,
            	    type: (options.type || 'POST'),
            	    beforeSend: options.beforeSend,
            	    error: options.error,
            	    complete: options.complete,
            	    success: function(data, textStatus, jqXHR) {
            	      if(typeof data == "object" && data.html) { //response is assumed to be JSON
            	        tag.html(data.html).dialog({modal: options.modal, title: data.title, width:700, height: 500, draggable: true}).dialog('open');
            	      } else { //response is assumed to be HTML
            	        tag.html(data).dialog({modal: options.modal,  
                	        buttons: {
            	        	Save: function() {
            	        	get(_url+'ave?f=in', '', cell_id, false, 'marksForm');
            	            $( this ).dialog( "close" );
            	          	},
            	        	Cancel: function() {
            	            $( this ).dialog( "close" );
            	          	}
            	        }, title: options.title, width:600, height: 400, draggable: true }).dialog('open');
            	      }
            	      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
            	      
            	    }
            	});
            }

			function onkeyup_student(obj, e){
		    	var admission_number = document.getElementById('admission_number').value;
		    	
		        if(e.keyCode == '13' || obj.value.length >= 11){
		        	marksheetForm.submit();
		        }
		    }
            </script>