<div class="col-md-12">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Grades / Levels List');?></div>
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
							<th><?php echo Base_Controller::ToggleLang('Name');?></th>
							<th><?php echo Base_Controller::ToggleLang('Min Score');?></th>
							<th><?php echo Base_Controller::ToggleLang('Actions');?></th>
						</tr>
					</thead>
					<tbody>					
						<?php $i=0;
                          if(isset($grade_list) && sizeof($grade_list) > 0){ 
							foreach($grade_list as $values){ $i++; 
								$url   = base_url().$model.'/edit_grade/';
								$param = 'grade_name='.$values->grade_name.'&min_scores='.$values->min_scores.'&batch_id='.$_POST['batch_id'].'&course_id='.$_POST['course_id'];								
								?>
	                          <tr>
	                          	<td><?php echo $values->grade_name?></td>
	                            <td><?php echo $values->min_scores;?></td> 
	                            <td>
		                            <!-- <a class="btn default btn-xs green-stripe" href="#">View</a> |  -->
		                            <a class="btn default btn-xs blue-stripe" onclick="<?php echo 'showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Update Grade Info\'}, \'123\')';?>" href="#">Edit</a> | 
		                            <a class="btn default btn-xs red-stripe" href="#" onclick="del_grade('<?php echo $values->batch_id;?>', '<?php echo $values->grade_name;?>');" >Delete</a>
	                            </td>
	                          </tr>
	                  <?php 	}
	                  
                          }else{
								echo '<tr><td colspan="3" align="center" style="height:100px; vertical-align:middle; color: red;font-size: 1.2em;">No Data Found!!</td></tr>';
						  }
						  $url   = base_url().$model.'/new_grade/';
						  $param = 'course_id='.$_POST['course_id'].'&batch_id='.$_POST['batch_id'];
						  echo '<tr><td colspan="3"><a class="btn default btn-xs blue-stripe" onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'New Exam\'}, \'123\')" href="#">New Grade</a>
									<a class="btn default btn-xs red-stripe" href="#" onclick="set_default_grading_levels(\''.$_POST['batch_id'].'\');" >Set Default Grading Levels</a>
								</td></tr>';
                          	?>
	                </tbody>
				</table>
				<input type="hidden" id="count" value="<?php echo $i;?>"/>
			</div>
		</div>
	</div>
</div>	
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>

<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script>
		jQuery(document).ready(function() {
			App.init();			
		});
</script>		