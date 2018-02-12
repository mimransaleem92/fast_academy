<div class="col-md-12">

	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption" ><?php echo Base_Controller::ToggleLang('GOSI');?></div>
			<div class="tools"><?php echo Base_Controller::ToggleLang('GOSI', 'ar');?></div>
		</div>
		<div class="portlet-body" >
			<div class="form-group">
				<div class="col-md-5">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Have you been registered in GOSI?');?><span class="required">*</span></label>
					<div class="form-group">
						<div class="make-switch" data-on-label="Y" data-off-label="N">
							<input type="checkbox" name="registered_gosi" id="registered_gosi" class="toggle" <?php if($form->registered_gosi == 'Y') echo 'checked="checked"';?> />
							
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Where');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="where_gosi" id="where_gosi" data-required="1" class="form-control" value="<?php echo $form->where_gosi;?>" >
						<span class="help-block"><?php echo form_error('where_gosi');?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				
				<div class="col-md-5">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Still registered or not?');?><span class="required">*</span></label>
					<div class="form-group">
						<div class="make-switch <?php if($form->gosi_still_registered == 'Y') echo 'active';?>" data-on-label="Y" data-off-label="N" >
							<input type="checkbox" name="gosi_still_registered" id="gosi_still_registered" class="toggle" <?php if($form->gosi_still_registered == 'Y') echo 'checked="checked"';?>/>
							
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
			</div>
			<div class="clearfix"></div>		
		</div>
	</div>
</div>