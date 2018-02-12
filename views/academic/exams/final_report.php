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
								$c = $this->session->userdata(SESSION_CONST_PRE.'course_id');
								$s = $this->session->userdata(SESSION_CONST_PRE.'section');
								foreach($courses_list as $course){
									$course_id = $course->course_id;
									if($course_id ==  $c) { $course_name = $course->course_name; break;}
								}	
								?>
								<div class="col-md-7">
									<div class="form-group">
	    								<input type="text" name="course_id" readonly="readonly" class="form-control col-md-6" id="course_id" value="<?php echo $course_name; ?>" style="width: 150px">
    									<input type="text" name="section" readonly="readonly" class="form-control col-md-4" id="section" value="<?php echo $s; ?>" style="width: 50px">
    								</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3 right"><?php echo Base_Controller::ToggleLang('Student #');?></label>
									<div class="col-md-5" >
										<input type="text" name="admission_number" class="form-control col-md-4" id="admission_number" value="<?php if(isset($_POST['admission_number'])) echo $_POST['admission_number']; ?>" placeholder="DIS-15-0000"  style="width: 150px" onkeyup="onkeyup_student(this, event)">
									</div>
									<div class="col-md-4" >
										<!-- <select name="term_id" class="form-control" id="term_id" style="width: 120px" onchange="marksheetForm.submit();">
						                	<option value="1" <?php  if(isset($_POST['term_id']) && ($_POST['term_id'] == '1')) echo 'selected';?>> First </option>
						                	<option value="2" <?php  if(isset($_POST['term_id']) && ($_POST['term_id'] == '2')) echo 'selected';?>> Second </option>
										</select> -->
										<a class="btn green" href="<?php echo base_url().$model.'/print_view/'.$student->student_id.'?admission_number='.$student->admission_number;?>" target="_blank"><i class="fa fa-print"></i> Print</a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row alert alert-info cl-md-12" id="tbl_marksheet" >
					 		<?php  $header_fields = array('student_name'=>'Student Name', 'country_name'=>'Nationality', 'date_of_birth'=>'Date of Birth', 'passport_id'=>'Passport No', 'iqama_id'=>'I D No', 'admission_date'=>'Admission Date', 'previous_school'=>'Previous School'); ?>
					 		<div class="row">
					 			<div class="col-lg-7 col-md-7 col-sm-12">
							 		<table border="1" style="border:2px solid #000; width: 100%; background-color: #FFF; color: #000;">
							 			<?php foreach ($header_fields as $field=>$caption){ ?>
						                <tr>
						                	<td width="50px"><?php echo Base_Controller::ToggleLang($caption);?>:</td>
						                	<td width="200px" style="text-align: center"><?php echo $student->$field;?></td>
						                </tr>
						            	<?php } ?>
				                	</table> 
				                	</div>
					 			<div class="col-lg-5 col-md-5 col-sm-12" style="padding-left: 0px ">
				                	<table border="1" style="border:2px solid #000; width: 100%; background-color: #FFF; color: #000;">
						                <?php foreach ($header_fields as $field=>$caption){ 
						                		if($field == 'student_name') $field = 'student_name_ar';
						                		elseif($field == 'country_name') $field = 'country_ar';

						                		if($field == 'previous_school') { 
						                			$value = Base_Controller::ToggleLang($student->$field, 'ar');
						                		}else{
						                			$value = Util::num($student->$field, 'ar');
						                		}
						                ?>
						                <tr>
						                	<td width="200px" style="text-align: center"><?php echo $value;?></td>
						                	<td width="120px" style="text-align: center"><?php echo Base_Controller::ToggleLang($caption, 'ar');?></td>
						                </tr>
						            	<?php } ?>
				                	</table>
			                	</div>
					 		</div>
					 		<div class="row">
					 			<div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center; font-weight: bolder; font-size: 14px;;color: #000;">
					 				<?php echo Base_Controller::ToggleLang('Student Grades').'<br/>'.Base_Controller::ToggleLang('Student Grades', 'ar');?>
					 			</div>
					 		</div>
					 		<div class="row">
					 			<div class="col-lg-12 col-md-12 col-sm-12" style="">
						 			<table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
						 				<tr>
						                	<td style="text-align: center; width: 200px;" rowspan="2"><?php echo Base_Controller::ToggleLang('Subject');?></td>
						                	<td style="text-align: center;" rowspan="2"><?php echo Base_Controller::ToggleLang('Subject', 'ar');?></td>
						                	<td align="center">
						                		<?php echo Base_Controller::ToggleLang('First Term'); ?>
						                	</td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Second Term');?></td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Final Marks of Both Terms');?></td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Credit Hours');?></td>
						                	<td style="width: 90px;text-align: center;" rowspan="2"><?php echo Base_Controller::ToggleLang('GPA');?></td>
						                	<td style="width: 90px;text-align: center;" ><?php echo Base_Controller::ToggleLang('Grading');?></td>
						                </tr>
						                <tr>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('First Term', 'ar');?></td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Second Term', 'ar');?></td>
						                	
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Final Marks', 'ar');?></td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Credit Hours', 'ar');?></td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Grading', 'ar');?></td>
						                </tr>
						                <?php $total1 = $total2 = $total_obtained = $credit_hours = 0;
						                	  $gpa_subject_total = $gpa_subject_count = 0;
						                	  $total_first = $total_second = 0; 
						                	if(isset($subject_list) && sizeof($subject_list)>0){
						                		foreach ($subject_list as $row){
							                		$title = explode(', ', $row->marksheet_title);
							                		$score = explode(', ', $row->marksheet_score);
							                		$first_term_total = $row_total = 0;
							                		$second_term_total = 0;
						                			if(isset($marks[$student->student_id][$row->subject_id][1])){
						                				
						                				$first_term_total += $marks[$student->student_id][$row->subject_id][1];
						                				$row_total += $marks[$student->student_id][$row->subject_id][1];
						                				$total1 += 50;
						                				$total_first += $first_term_total;
					                				}
					                				if(isset($marks[$student->student_id][$row->subject_id][2])){
					                				
					                					$second_term_total += $marks[$student->student_id][$row->subject_id][2];
					                					$row_total += $marks[$student->student_id][$row->subject_id][2];
					                					$total2 += 50;
					                					$total_second += $second_term_total;
					                				}
						                			
						                			if($row->subject_id <=23){
						                				$gpa_subject_count++;
						                				$gpa_subject_total += $row_total;  
						                			}
						                			$credit_hours += $row->credit_hours;
						                			$total_obtained += $row_total;
						                	?>
						                <tr>
						                	<td align="left" style="padding-left: 4px"><?php echo $row->subject_name;?></td>
						                	<td align="right" style="padding-right: 4px"><?php echo $row->subject_name_arabic;?></td>
						                	
						                	<td align="center"><?php echo $first_term_total;?></td>
						                	<td align="center"><?php echo $second_term_total;?></td>
						                	
						                	<td align="center"><?php echo $row_total;?></td>
						                	<td align="center"><?php echo $row->credit_hours;?></td>
						                	<td align="center"><?php echo Util::final_gpa($row_total);?></td>
						                	<td align="center"><?php echo Util::final_grade($row_total);?></td>
						                </tr>
						                <?php }
						                	} 
						                	$total_gpa = 0;
						                	if($gpa_subject_count > 0) {
						                		$total_gpa = $gpa_subject_total / $gpa_subject_count;
						                	}
						                ?>
						                <tr>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Obtained Marks');?></td>
						                	<td></td>
						                	
						                	<td align="center"><?php echo number_format($total_first, 2);?></td>
						                	<td align="center"><?php echo number_format($total_second, 2);?></td>
						                	
						                	<td align="center"><?php echo number_format($total_obtained, 2);?></td>
						                	<td align="center"><?php echo number_format($credit_hours, 2);?></td>
						                	<td align="center" colspan="2"><?php echo 'GPA';?></td>
						                	
						                </tr>
						                <tr>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Total');?></td>
						                	<td></td>
						                	
						                	<td align="center"><?php echo $total1;?></td>
						                	<td align="center"><?php echo $total2;?></td>
						                	
						                	<td align="center"><?php echo $total1+$total2;?></td>
						                	<td align="center"><?php echo number_format($total_gpa, 2);?></td>
						                	<td align="center"><?php echo Util::final_gpa($total_gpa);?></td>
						                	<td align="center"><?php echo Util::final_grade($total_gpa);?></td>
						                </tr>	
					            	</table>
					            </div>	
				            </div>	
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