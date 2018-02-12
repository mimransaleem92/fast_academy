<div class="col-md-12">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Subjects Schedule');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="table-responsive" id="divParticularList">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th width="4%"></th>
							<th width="20%"><?php echo Base_Controller::ToggleLang('Subject');?></th>
							<th width="15%"><?php echo Base_Controller::ToggleLang('Start Time');?></th>
							<th width="15%"><?php echo Base_Controller::ToggleLang('End Time');?></th>
							<th width="10%"><?php echo Base_Controller::ToggleLang('Max Marks');?></th>
							<th><?php echo Base_Controller::ToggleLang('Actions');?></th>
							<th><?php echo Base_Controller::ToggleLang('Manage');?></th>
						</tr>
					</thead>
					<tbody>					
						<?php $i=0;
                          if(isset($subject_list) && sizeof($subject_list) > 0){ 
							foreach($subject_list as $values){ $i++; 
								$param = 'course_id='.$_POST['course_id'].'&batch_id='.$_POST['batch_id'].'&exam_id='.$values->exam_id;//.$values->subject_id;
								$url = base_url().$model.'/edit_schedule/'.$values->id;
								?>
	                          <tr>
	                          	<td><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" value="<?php echo $values->subject_id;?>" /></td>
	                            <td id="sub_name<?php echo $values->id;?>"><?php echo $values->subject_name?></td>
	                            <td><?php echo Util::dateDisplayFormateWithTime($values->start_time);?></td>
	                            <td><?php echo Util::dateDisplayFormateWithTime($values->end_time);?></td>
	                            <td><?php echo $values->max_marks;?></td>
	                            <td>
		                            <a class="btn default btn-xs blue-stripe" onclick="<?php echo 'showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Update Schedule\'}, \'123\')';?>" href="#">Edit</a> | 
		                            <a class="btn default btn-xs red-stripe" href="#" onclick="del_schedule('<?php echo $values->id;?>', '<?php echo $values->exam_id;?>');">Delete</a>
	                            </td>
	                            <td><a class="btn default btn-xs blue-stripe" href="#" onclick="exam_score_subject('<?php echo $values->id;?>', '<?php echo $values->exam_id;?>');">Exam Score</a></td>
	                          </tr>
	                  <?php 	}	                  
                          }else{
								echo '<tr><td colspan="7" align="center" style="height:100px; vertical-align:middle; color: red;font-size: 1.2em;">No Data Found!!</td></tr>';
						  }
						  $url   = base_url().$model.'/add_schedule/';
						  $param = 'course_id='.$_POST['course_id'].'&batch_id='.$_POST['batch_id'].'&exam_id='.$exam_id;
						  echo '<tr><td colspan="5" >&nbsp;</td><td colspan="2"><a class="btn default btn-xs blue-stripe" onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Subject Schedule\'}, \'123\')" href="#">Add Subject Schedule</a> | ';
						  echo '<a class="btn default btn-xs blue-stripe" onclick="onchange_batch('.$_POST['batch_id'].')" href="#">Back</a></td></tr>';
                          	?>
	                </tbody>
				</table>
				<input type="hidden" id="count" value="<?php echo $i;?>"/>
			</div>
		</div>
	</div>
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