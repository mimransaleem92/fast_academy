
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
				       		<td><?php echo Base_Controller::ToggleLang('Grade Name');?></td>
					       	<td><input type="text" class="form-control" id="grade_name" name="grade_name" value=''  /></td>
				       	</tr>
				       	<tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Min Scores');?></td>
					       	<td><input type="text" class="form-control" id="min_scores" name="min_scores" value=''  /></td>
				       	</tr>
				       	<tr> 
				       		<td></td>
				       		<td>
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