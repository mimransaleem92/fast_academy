		<!-- 
			<table border="0">
						<tr>
							<td width="70" nowrap="nowrap"><?php echo Base_Controller::ToggleLang('Available');?></td>
							<td align="center" valign="middle" width="70" nowrap="nowrap"></td>
							<td width="70" nowrap="nowrap"><?php echo Base_Controller::ToggleLang('Selected');?></td>
							<td nowrap="nowrap">&nbsp;</td>
						</tr>
						<tr>
							<td width="70" nowrap="nowrap">
								<select name="availableScreens" id="availableScreens" size="5" multiple="multiple">									
				                    <?php foreach($available_scr as $v){ 
				                    	$id = $v->screen_id;
				                    	?> 
				                    	<option value="<?php echo $id;?>"><?php echo Base_Controller::ToggleLang($v->name);?></option>
				                    <?php } ?>	
										
								</select>
							</td>
							<td align="center" valign="middle" width="70" nowrap="nowrap">
								<input type="button" value="--&gt;"
								 onclick="moveOptions(this.form.availableScreens, this.form.selected_screens);" /><br />
								<input type="button" value="&lt;--"
								 onclick="moveOptions(this.form.selected_screens, this.form.availableScreens);" />
							</td>
							<td width="70" nowrap="nowrap">
								<select name="selected_screens[]" id="selected_screens" size="5" multiple="multiple" >
								 <?php foreach($selected_scr as $s){ 
				                    	$id = $s->screen_id;
				                    	?> 
				                    	<option value="<?php echo $id;?>"><?php echo Base_Controller::ToggleLang($s->name);?></option>
				                    <?php } ?>
								</select>
							</td>
							<td nowrap="nowrap" valign="top"></td>
						</tr>
					</table> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/jquery-multi-select/css/multi-select.css" />

<div class="col-md-12">
	<!-- BEGIN FORM-->
	<?php  
		    echo form_open('screen/update',array('id'=>'mainForm', 'class'=>"form-horizontal"));
		    echo form_hidden("role_id",$role_id);
	?>
		<div class="form-body">
			<div class="alert alert-danger display-hide">
				<button class="close" data-close="alert"></button>
				You have some form errors. Please check below.
			</div>
			<div class="alert alert-success display">
				<?php echo Base_Controller::ToggleLang('Select Screens for').' <b>'.$role_name[0]->name.'</b>';?>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Default</label>
				<div class="col-md-4">
					<select multiple="multiple" class="multi-select" id="availableScreens" name="availableScreens[]">
						<?php 
							foreach($selected_scr as $v){ $id = $v->screen_id; ?>
								<option value="<?php echo $id;?>" selected ><?php echo $v->name;?></option>
							<?php }
							foreach($available_scr as $v){ $id = $v->screen_id; ?> 
	                    	<option value="<?php echo $id;?>" ><?php echo $v->name;?></option>
	                    <?php } ?>
					</select>
				</div>
			</div>
			<div class="form-actions fluid">
				<div class="col-md-offset-3 col-md-9">
					<button type="button" class="btn blue" onclick="submitForm()" ><i class="fa fa-check"></i> Submit</button>
					<button type="button" class="btn default" onclick="window.open('<?php echo base_url().$model;?>', '_self')" >Cancel</button>
					                              
				</div>
			</div>
	<?php echo form_close();?>
	<!-- END FORM-->
</div>
              
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>

<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/form-validation.js"></script> 
<script>
		jQuery(document).ready(function() { 
			App.init();		
			$('#availableScreens').multiSelect();
			FormValidation.init();
		});
</script>           