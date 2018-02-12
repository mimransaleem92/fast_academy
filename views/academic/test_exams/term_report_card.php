<link type="text/css" href="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js"></script>
<style>
<!--
.noclose .ui-dialog-titlebar-close
{
    display:none;
}
-->
</style>
				<form id="marksheetForm" method="post" >
					<div class="form-body">
						<div class="row alert alert-success">
							<div class="col-md-6">
								<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Course Name').' / '.Base_Controller::ToggleLang('Section');?></label>
								<?php 
								$c = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
								$sec = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
								$admin_user = ($this->session->userdata(SESSION_CONST_PRE.'role_id') == 1) ? true : false;;
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
									<!-- <label class="control-label col-md-2 right"><?php echo Base_Controller::ToggleLang('Term');?></label> -->
									<div class="col-md-5" >
										<?php $student = $student_list[0]; $term_name = 'First'; $t = isset($_POST['term']) ? $_POST['term'] : '1'; ?>
										<select name="term" class="form-control" id="term" onchange="marksheetForm.submit();">
						                	<?php foreach ($term_list as $tr){ ?>
						                		<option value="<?php echo $tr->id;?>" <?php  if(isset($_POST['term']) && ($_POST['term'] == $tr->id)) { echo 'selected'; $term_name = $tr->name;}?>> <?php echo $tr->name;?> </option>
						                	<?php } ?>
										</select>
									</div>
									<div class="col-md-5" >
										<input type="text" name="admission_number" class="form-control" id="admission_number" value="<?php if(isset($_POST['admission_number'])) echo $_POST['admission_number']; ?>" placeholder="DIS-15-0000"  style="width: 150px" onkeyup="onkeyup_student(this, event)">
									</div>
									<div class="col-md-2" >
										<a class="btn green" href="<?php echo base_url().$model.'/print_view/?admission_number='.$student->admission_number."&t=". $t;?>" target="_blank"><i class="fa fa-print"></i> Print</a>
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
						                		<?php echo Base_Controller::ToggleLang($term_name.' Term').'<br/>';
						                			  echo Base_Controller::ToggleLang('Exam'); ?>
						                	</td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Homework');?></td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Classwork');?></td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Total');?></td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Credit Hours');?></td>
						                	<td style="text-align: center;" rowspan="2"><?php echo Base_Controller::ToggleLang('GPA');?></td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Grading');?></td>
						                </tr>
						                <tr>
						                	<td align="center"><?php echo Base_Controller::ToggleLang($term_name.' Term', 'ar');?></td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Homework', 'ar');?></td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Classwork', 'ar');?></td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Total', 'ar');?></td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Credit Hours', 'ar');?></td>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Grading', 'ar');?></td>
						                </tr>
						                <?php $total = $total_obtained = $credit_hours = 0;
						                	  $gpa_subject_total = $gpa_subject_count = 0; 
						                	if(isset($subject_list) && sizeof($subject_list)>0){
						                		foreach ($subject_list as $row){
							                		$title = explode(', ', $row->marksheet_title);
							                		$score = explode(', ', $row->marksheet_score);
							                		$total_from = $subject_total = $row_total = 0;
							                		$homework = 0;
							                		$classwork = 0;
							                		for ($i=0; $i<count($title); $i++){
							                			$total_from += $score[$i];
														if($row->subject_id >= 25){
							                				$homework = $classwork = '-';
							                				$subject_total = '-';
							                				$row_total += $score[$i];
							                				$total += $score[$i];
							                			}else{
								                			if(isset($marks[$student->student_id][$row->subject_id][$i])){
								                				
								                				if(!in_array($title[$i],array('HW', 'CW', 'H.W', 'C.W', 'C.W Evaluation'))){
								                					$subject_total += $marks[$student->student_id][$row->subject_id][$i];
								                				}
								                				elseif(in_array($title[$i],array('HW', 'H.W'))){
								                					$homework = $marks[$student->student_id][$row->subject_id][$i];
								                				}
								                				elseif(in_array($title[$i],array('CW', 'C.W', 'C.W Evaluation'))){
								                					$classwork += $marks[$student->student_id][$row->subject_id][$i];
								                				}
								                				
								                				$row_total += $marks[$student->student_id][$row->subject_id][$i];
								                				$total += $score[$i];
							                				}
							                			}
						                			}
													$weighted_average = ($row_total/$total_from)*100;
													$row_gpa = Util::gpa($weighted_average);
						                			if($row->subject_id <=23){
						                				$gpa_subject_count++;
						                				//$gpa_subject_total += $row_total;
														$gpa_subject_total += $row_gpa*$row->credit_hours;
						                				$credit_hours += $row->credit_hours;
						                			}
						                			$total_obtained += $row_total;
						                	?>
						                <tr>
						                	<td align="left" style="padding-left: 4px"><?php echo $row->subject_name;?></td>
						                	<td align="right" style="padding-right: 4px"><?php echo $row->subject_name_arabic;?></td>
						                	
						                	<td align="center"><?php echo $subject_total;?></td>
						                	<td align="center"><?php echo $homework;?></td>
						                	<td align="center"><?php echo $classwork;?></td>
						                	
						                	<td align="center"><?php echo $row_total;?></td>
						                	<td align="center"><?php echo ($row->subject_id >= 25) ? '-' : $row->credit_hours;?></td>
						                	<td align="center"><?php echo ($row->subject_id >= 25) ? '-' : Util::gpa($weighted_average);?></td>
						                	<td align="center"><?php echo Util::get_grade($weighted_average);?></td>
						                </tr>
						                <?php }
						                	} 
						                	$total_gpa = 0;
						                	if($gpa_subject_count > 0) {
						                		//$total_gpa = $gpa_subject_total / $gpa_subject_count;
												$total_gpa = $gpa_subject_total / $credit_hours;
						                	}
											$total_average = ($total_obtained -150)*100 / ($total-150);
						                ?>
						                <tr>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Obtained Marks');?></td>
						                	<td></td>
						                	
						                	<td align="center"></td>
						                	<td align="center"></td>
						                	<td align="center"></td>
						                	
						                	<td align="center"><?php echo number_format($total_obtained, 2);?></td>
						                	<td align="center"><?php echo number_format($credit_hours, 2);?></td>
						                	<td align="center" rowspan="2"><?php echo 'GPA';?></td>
						                	<td align="center"><?php echo number_format($total_gpa, 2);?></td>
						                </tr>
						                <tr>
						                	<td align="center"><?php echo Base_Controller::ToggleLang('Total');?></td>
						                	<td></td>
						                	
						                	<td align="center"></td>
						                	<td align="center"></td>
						                	<td align="center"></td>
						                	
						                	<td align="center"><?php echo $total;?></td>
						                	<td align="center"><?php echo number_format($total_average, 2);?></td>
						                	<!-- <td align="center" rowspan="2"> GPA</td> -->
						                	<td align="center"><?php echo Util::get_grade($total_average);?></td>
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