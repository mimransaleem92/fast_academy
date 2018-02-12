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
										<a class="btn green" href="<?php echo base_url().$model.'/print_view/?admission_number='.$student->admission_number."&term=". $t;?>" target="_blank"><i class="fa fa-print"></i> Print</a>
									</div>
								</div>
							</div>
						</div>
	          <div class="row alert alert-info cl-md-12" id="tbl_marksheet" >
              <?php  $header_fields = array('student_name'=>'Student Name', 'country_name'=>'Nationality', 'date_of_birth'=>'Date of Birth', 'passport_id'=>'Passport No', 'iqama_id'=>'I D No', 'admission_date'=>'Admission Date', 'previous_school'=>'Previous School');
                // position code
                $marks_arr =array();
                foreach ($position as $row)
                {
                  $marks_arr[$row->student_id] = $row->obtain_marks+150;
                }
                rsort($marks_arr); $position_arr = array();
                foreach($marks_arr as $id => $m){
                  $position_arr[$m] = ++$id;
                }
              ?>
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
                  <table border="1" style="border: 2px solid #000; width: 100%; background-color: #eaffea; color: #000;">
    				 				<tr>
    				                	<td style="text-align: center; width: 260px;" rowspan="2"><?php echo Base_Controller::ToggleLang('Subject');?></td>
    				                	<td style="text-align: center;" rowspan="2"><?php echo Base_Controller::ToggleLang('Subject', 'ar');?></td>
    				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Max');?></td>
    													<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Activities');?></td>
    													<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Quiz');?></td>
    													<td align="center" width="65px">
    				                		<?php echo Base_Controller::ToggleLang('Quarter Exam'); ?>
    				                	</td>
    				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Total');?></td>
    				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Credit Hours');?></td>
    				                	<td style="text-align: center;" rowspan="2" width="65px"><?php echo Base_Controller::ToggleLang('GPA');?></td>
    				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Grading');?></td>
    				                </tr>
    				                <tr>
    													<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Max', 'ar');?></td>
    													<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Activities', 'ar');?></td>
    													<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Quiz', 'ar');?></td>
    				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Quarter Exam', 'ar');?></td>
    				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Total', 'ar');?></td>
    				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Credit Hours', 'ar');?></td>
    				                	<td align="center" width="65px"><?php echo Base_Controller::ToggleLang('Grading', 'ar');?></td>
    				                </tr>
    				                <?php $total = $total_obtained = $credit_hours = 0;
    				                	  $gpa_subject_total = $gpa_subject_count = 0;
    				                	if(isset($subject_list) && sizeof($subject_list)>0){
    				                		foreach ($subject_list as $row){
    					                		$title = explode(', ', $row->marksheet_title);
    					                		$score = explode(', ', $row->marksheet_score);
    					                		$total_from = $exams = $row_total = 0;
    					                		$activity_total = $exams = $quiz = 0;
    					                		for ($i=0; $i<count($title); $i++){
    																$total_from += $score[$i];
    					                			if($row->subject_id >= 25){
    					                				$activity_total = $quiz = '-';
    					                				$row_total += $score[$i];
    					                				$total += $score[$i];
    																	$exams += $score[$i];
    					                			}else{
    						                			if(isset($marks[$student->student_id][$row->subject_id][$i])){

    																		if(in_array($title[$i],array('Quarter'))){
    						                					$exams = $marks[$student->student_id][$row->subject_id][$i];
    						                				}
    						                				elseif(in_array($title[$i],array('Quiz'))){
    						                					$quiz = $marks[$student->student_id][$row->subject_id][$i];
    						                				}
    																		else
    																		{
    						                					$activity_total += $marks[$student->student_id][$row->subject_id][$i];
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
          				                		// $gpa_subject_total += $row_total;
          												    $gpa_subject_total += $row_gpa*$row->credit_hours;
  				                			      $credit_hours += $row->credit_hours;
                                  }
    				                			$total_obtained += $row_total;
    				                	?>
    				                <tr style="background-color: #FFF">
    				                	<td align="left" style="padding-left: 4px"><?php echo $row->subject_name;?></td>
    				                	<td align="right" style="padding-right: 4px"><?php echo $row->subject_name_arabic;?></td>
    													<td align="center"><?php echo $total_from;?></td>
    				                	<td align="center"><?php echo $activity_total;?></td>
    				                	<td align="center"><?php echo $quiz;?></td>
    													<td align="center"><?php echo $exams;?></td>

    				                	<td align="center"><?php echo $row_total;?></td>
    				                	<td align="center"><?php echo ($row->subject_id >= 25) ? '-' : $row->credit_hours;?></td>
    				                	<td align="center"><?php echo ($row->subject_id >= 25) ? '-' : Util::gpa($weighted_average);?></td>
    				                	<td align="center"><?php echo Util::get_grade($weighted_average);?></td>
    				                </tr>
    				                <?php }
    				                	}
    				                	$total_gpa = 0;
    				                	if($gpa_subject_count > 0) {
    				                		$total_gpa = $gpa_subject_total / $credit_hours;
    				                	}
            									$total_average = ($total > 150) ? ($total_obtained)*100 / $total : '0';
            									//$total_average = ($total_obtained -150)/$gpa_subject_count;
    				                ?>
    				                <tr style="font-weight: bold;">
    				                	<td colspan="3"></td>
    				                	<td align="center" colspan="2">
    														<?php if($total_obtained > 150) { echo 'Position: '.$position_arr[$total_obtained];
    														switch($position_arr[$total_obtained]){
    															case '1': echo 'st'; break;
    															case '2': echo 'nd'; break;
    															case '3': echo 'rd'; break;

    															default: echo 'th';
    														}  } ?>
    													</td>
    													<td align="right"><?php echo Base_Controller::ToggleLang('Total');?>:</td>
    				                	<td align="center"><?php echo number_format($total_obtained, 2);?></td>
    				                	<td align="center"><?php echo number_format($credit_hours, 2);?></td>
    				                	<td align="center" rowspan="2"><?php echo 'GPA';?></td>
    				                	<td align="center"><?php echo number_format($total_gpa, 2);?></td>
    				                </tr>
    				                <tr style="font-weight: bold;">
    													<td align="center" colspan="5"></td>
    													<td align="right"><?php echo Base_Controller::ToggleLang('Out of');?>:</td>
    				                	<td align="center"><?php echo $total;?></td>
    				                	<td align="center"><?php echo number_format($total_average, 2).'%';?></td>
    				                	<!-- <td align="center" rowspan="2"> GPA</td> -->
    				                	<td align="center"><?php echo Util::get_grade($total_average);?></td>
    				                </tr>
    			            	</table>
					 	</div>
				 	</div>
			  </form>
<div id="dialog-form"></div>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script type="text/javascript" >
		jQuery(document).ready(function() {
		   // initiate layout and plugins
		   App.init();
		});

    function onchange_courses(val){
      if(val != ''){

    		get('<?php echo base_url().'timetable/batches/';?>'+val, '', 'td_batch','false','');
      }
    }
    function onkeyup_student(obj, e){
        var admission_number = document.getElementById('admission_number').value;
        if(e.keyCode == '13' || obj.value.length >= 11){
          marksheetForm.submit();
        }
    }
</script>
