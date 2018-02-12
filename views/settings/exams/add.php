<div class="col-md-12">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Exams List');?></div>
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
							<th></th>
							<th><?php echo Base_Controller::ToggleLang('Exam Name');?></th>
							<th><?php echo Base_Controller::ToggleLang('Exam Type');?></th>							
							<th><?php echo Base_Controller::ToggleLang('Exam Date');?></th>
							<th><?php echo Base_Controller::ToggleLang('Is Published');?></th>
							<th><?php echo Base_Controller::ToggleLang('Result Published');?></th>
							<th><?php echo Base_Controller::ToggleLang('Actions');?></th>
							<th><?php echo Base_Controller::ToggleLang('Manage');?></th>
						</tr>
					</thead>
					<tbody>					
						<?php $i=0;
                          if(isset($exam_list) && sizeof($exam_list) > 0){ 
							foreach($exam_list as $values){ $i++; 
								$url   = base_url().$model.'/edit_exam/';
								$param = 'course_id='.$_POST['course_id'].'&batch_id='.$_POST['batch_id'].'&exam_id='.$values->id;								
								?>
	                          <tr>
	                          	<td><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" value="<?php echo $values->id;?>" /></td>
	                            <td id="exam_name<?php echo $values->id;?>"><?php echo $values->exam_name?></td>
	                            <td><?php echo $values->exam_type;?></td>
	                            <td><?php echo ($values->exam_date);?></td>
	                            <td><?php echo ($values->is_published == 'Y') ? 'Yes': 'No';?></td>
	                            <td><?php echo ($values->result_published == 'Y') ? 'Yes': 'No';?></td>	 
	                            <td>
		                            <a class="btn default btn-xs green-stripe" href="#">View</a> | 
		                            <a class="btn default btn-xs blue-stripe" onclick="<?php echo 'showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Update Exam\'}, \'123\')';?>" href="#">Edit</a> | 
		                            <a class="btn default btn-xs red-stripe" href="#" onclick="del_exams('<?php echo $values->id;?>');" >Delete</a>
	                            </td>
	                            <td><a class="btn default btn-xs blue-stripe" onclick="manage_exams('<?php echo $values->id;?>')" href="#" target="_self">Manage This Exam</a></td>
	                          </tr>
	                  <?php 	}
	                  
                          }else{
								echo '<tr><td colspan="8" align="center" style="height:100px; vertical-align:middle; color: red;font-size: 1.2em;">No Exam Found!!</td></tr>';
						  }
						  $url   = base_url().$model.'/new_exam/';
						  $param = 'course_id='.$_POST['course_id'].'&batch_id='.$_POST['batch_id'];
						  echo '<tr><td colspan="6" >&nbsp;</td><td colspan="2"><a class="btn default btn-xs blue-stripe" onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'New Exam\'}, \'123\')" href="#">New Exam</a></td>';
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

<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/scripts/form-validation.js"></script>  
<script>
		jQuery(document).ready(function() {
			App.init();
			FormValidation.init();
			
		});
</script>		