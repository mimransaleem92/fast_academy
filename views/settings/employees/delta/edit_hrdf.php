<div class="col-md-12">

	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption" ><?php echo Base_Controller::ToggleLang('HRDF (Mawarid)');?></div>
			<div class="tools"><?php echo Base_Controller::ToggleLang('HRDF', 'ar');?></div>
		</div>
		<div class="portlet-body" >
			<div class="form-group">
				<div class="col-md-5">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Have you been registered in HRDF (Mawarid)?');?><span class="required">*</span></label>
					<div class="form-group">
						<div class="make-switch <?php if($form->registered_hrdf == 'Y') echo 'active';?>" data-on-label="Y" data-off-label="N">
							<input type="checkbox" name="registered_hrdf" id="registered_hrdf" class="toggle" <?php if($form->registered_hrdf == 'Y') echo 'checked="checked"';?>/>
							
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Where');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="where_hrdf" id="where_hrdf" data-required="1" class="form-control" value="<?php echo $form->where_hrdf;?>" >
						<span class="help-block"><?php echo form_error('where_hrdf');?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				
				<div class="col-md-5">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Still registered or not?');?><span class="required">*</span></label>
					<div class="form-group">
						<div class="make-switch <?php if($form->hrdf_still_registered == 'Y') echo 'active';?>" data-on-label="Y" data-off-label="N">
							<input type="checkbox" name="hrdf_still_registered" id="hrdf_still_registered" class="toggle" <?php if($form->hrdf_still_registered == 'Y') echo 'checked="checked"';?>/>
							
						</div>
					</div>	
				</div>
				<div class="col-md-offset-2 col-md-5"> </div>
			</div>
			<div class="form-group">
				<div class="col-md-5">
					<button type="button" class="btn blue" onclick="submitForm()" ><i class="fa fa-check"></i> Submit</button>
					<button type="button" class="btn default" onclick="window.open('<?php echo base_url().$model;?>', '_self')" >Cancel</button>
				</div>
				<div class="col-md-offset-2 col-md-5"> </div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>