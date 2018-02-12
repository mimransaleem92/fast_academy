<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-reorder"></i><?php echo Base_Controller::ToggleLang('Emergency Details');?></div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php echo form_open('students/add_emergency_detail',array('id'=>'emergencyDetailForm', 'class'=>"form-horizontal")); ?>
			<input type="hidden" id="student_id" name="student_id" value='<?php echo $_REQUEST['student_id'];?>'  />
			<div class="form-body">
				<!--<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Emergency Details');?></h3>-->
				<div class="table-responsive">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<td align="center"><b><?php echo Base_Controller::ToggleLang('Guardian Name');?></b></td>
							<td align="center"><b><?php echo Base_Controller::ToggleLang('Relationship');?></b></td>
						</tr>
					</thead>
					<tbody>
						<tr>
                            <td align="center"><input class='form-control' type="radio" name="default_contact" id="default_contact" value='1' checked="checked"/></td>
                            <td align="center"><?php echo Base_Controller::ToggleLang('Father');?></td>
						</tr> 
						                            
					</tbody>
				</table>	
				</div>
			<?php echo form_close();?>
			<!-- END FORM-->                
		</div>
	</div>
</div>