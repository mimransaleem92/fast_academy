<?php 
function get_grading($val, $grading_arr=array()){
	$flag = 'F';
	foreach ($grading_arr as $grade=>$score){
		if($val >= $score){
			$flag = $grade;
		}
	}
	return $flag;
}
?>
<div class="col-md-12">
	<form action="" method="post" id="student_scores_form">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Exam Scores');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-responsive" id="divParticularList">
				
				<?php if(isset($score_list) && sizeof($score_list)>0){ ?>
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th width="30%"><?php echo Base_Controller::ToggleLang('Student Name');?></th>
							<th width="10%"><?php echo Base_Controller::ToggleLang('Marks');?></th>
							<th width="10%"><?php echo Base_Controller::ToggleLang('Grades');?></th>
							<th width="40%"><?php echo Base_Controller::ToggleLang('Remarks');?></th>
							<th width=""><?php echo Base_Controller::ToggleLang('Actions');?></th>
						</tr>
					</thead>
					<tbody>
					<?php $i = 0; $grade = array();
					if(isset($grading_levels) && sizeof($grading_levels) > 0){
						foreach($grading_levels as $g){
							$grade[$g->grade_name] = $g->min_scores;
						}
					}
					else{
						$grade = array('F'=>40, 'E'=>50, 'D'=>60, 'C'=>70, 'B'=>80 ,'A'=>90);
					}
					//print_r($grade);
					foreach($score_list as $values){ $i++; 
						$param = 'course_id='.$_POST['course_id'].'&batch_id='.$_POST['batch_id'].'&student_id='.$values->student_id.'&exam_id='.$values->exam_id;
						$url   = base_url().$model.'/edit_scores/'.$values->exam_detail_id;
						echo '<tr><td>'.$values->student_name.'</td>';
						echo '<td>'.$values->score_obtained.'</td>';
						
						$grade_val = get_grading($values->score_obtained, $grade);
						
						echo '<td>'.$grade_val.'</td>';
						echo '<td>'.$values->remarks.'</td>';
						echo '<td><a class="btn default btn-xs blue-stripe" onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Update Score\'}, \'123\')" href="#">Edit</a></td></tr>'; 
		                //echo '<a class="btn default btn-xs red-stripe"  onclick="del_score(\''.$values->exam_detail_id.'\', \''.$values->subject_id.'\');" href="#" >Delete</a></td></tr>';
					}
						echo '<tr><td colspan="5"><a class="btn default btn-xs blue-stripe" onclick="clear_all_scores(\''.$exam_detail_id.'\', \''.$_POST['exam_id'].'\')" href="#">Clear Scores</a> | <a class="btn default btn-xs blue-stripe" onclick="manage_exams('.$_POST['exam_id'].')" href="#">Back</a></td></tr>';
					?>
					</tbody>
				</table>	
				<?php 
				}
				else{
				?>
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th width="30%"><?php echo Base_Controller::ToggleLang('Student Name');?></th>
							<th width="15%"><?php echo Base_Controller::ToggleLang('Marks');?></th>
							<th width=""><?php echo Base_Controller::ToggleLang('Remarks');?></th>
						</tr>
					</thead>
					<tbody>					
						<?php $i=0;
                          if(isset($student_list) && sizeof($student_list) > 0){ 
							foreach($student_list as $values){ $i++; 
								//$param = 'course_id='.$_POST['course_id'].'&batch_id='.$_POST['batch_id'].'&exam_id='.$values->exam_id;//.$values->subject_id;
								//$url = base_url().$model.'/edit_schedule/'.$values->id;
								?>
	                          <tr>
	                          	<td><?php echo $values->student_name?><input type="hidden" name="student_id[]" id="student_id_<?php echo $i;?>" value="<?php echo $values->student_id;?>"></td>
	                            <td><input type="text" name="score_obtained[]" id="score_obtained_<?php echo $i;?>" value=""></td>
	                            <td><input type="text" name="remarks[]" id="remarks_<?php echo $i;?>" value="" style="width: 100%"></td>
	                          </tr>
	                  <?php 	}	                  
                          }else{
								echo '<tr><td colspan="3" align="center" style="height:100px; vertical-align:middle; color: red;font-size: 1.2em;">No Student Enrolled!!</td></tr>';
						  }
						  $url   = base_url().$model.'/add_schedule/';
						  $param = 'course_id='.$_POST['course_id'].'&batch_id='.$_POST['batch_id'].'&exam_id='.$_POST['exam_id'];
						  echo '<tr><td colspan="3"><a class="btn default btn-xs blue-stripe" onclick="submit_scores();" href="#">Submit Scores</a> | ';
						  echo '<a class="btn default btn-xs blue-stripe" onclick="manage_exams('.$_POST['exam_id'].')" href="#">Back</a></td></tr>';
                          	?>
	                </tbody>
				</table>
				<input type="hidden" id="count" name="subject_count" value="<?php echo $i;?>"/>
				<input type="hidden" id="exam_detail_id" name="exam_detail_id" value="<?php echo $exam_detail_id;?>"/>
				<input type="hidden" id="exam_id" name="exam_id" value="<?php echo $_POST['exam_id'];?>"/>
				<?php }?>
				
			</div>
		</div>
	</div>
	</form>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js" type="text/javascript" ></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/scripts/ajax.js"></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/scripts/form-validation.js"></script>  
<script>
		jQuery(document).ready(function() {
			App.init();
			FormValidation.init();
			
		});
</script>		