<?php $form=$form[0]; //print_r($form)?>
<div class="col-md-12">
<!-- BEGIN CONDENSED TABLE PORTLET-->
<div class="portlet box blue">
		<!--<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('New Exam');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div
		</div>>-->
		<div class="portlet-body">
			<div class="table-responsive">
				<form action="" method="post" id="mainForm">
					<input type="submit" id="sub_btn" value='0' onclick="return false;" style="display: none;"/>
				<table class="table table-condensed">
					<tbody>
						<tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Student Name');?></td>
					       	<td><input type="text" class="form-control" id="student_name" value='<?php echo $form->student_name;?>' readonly="readonly" /></td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Exam Detail');?></td>
				       		<td><input type="text" class="form-control" id="subject_name" value='' readonly="readonly" /></td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Marks Obtained');?></td>
				       		<td><input type="text" class="form-control" id="score_obtained" name="score_obtained" value='<?php echo $form->score_obtained;?>'  /></td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Remarks');?></td>
				       		<td><input type="text" class="form-control" id="remarks" name="remarks" value='<?php echo $form->remarks;?>'  /></td>
				       </tr>
				       <tr> 
				       		<td></td>
				       		<td>
			       				<input type="hidden" class="form-control" id="student_id" name="student_id" value='<?php echo $form->student_id;?>' />
			       				<input type="hidden" class="form-control" id="exam_detail_id" name="exam_detail_id" value='<?php echo $form->exam_detail_id;?>' />
			       				<input type="hidden" class="form-control" id="exam_id" name="exam_id" value='<?php echo $_GET['exam_id'];?>' />
				       			<input type="hidden" class="form-control" id="course_id" name="course_id" value='<?php echo $_GET['course_id'];?>' />
			       				<input type="hidden" class="form-control" id="batch_id" name="batch_id" value='<?php echo $_GET['batch_id'];?>' /> 
				       		</td>
				       </tr>
					</tbody>
				</table>
				</form>
			</div>
		</div>
	</div>
</div>
<script> 
var str = parent.document.getElementById('div_tree').innerHTML;
var val = str.replace("gt;", "");
document.getElementById('subject_name').value = val;</script>