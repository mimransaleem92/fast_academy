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
						<div class="make-switch" data-on-label="Y" data-off-label="N">
							<input type="checkbox" name="registered_hrdf" id="registered_hrdf" class="toggle"/>
							
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Where');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="where_hrdf" id="where_hrdf" data-required="1" class="form-control" value="<?php echo set_value('where_hrdf');?>" >
						<span class="help-block"><?php echo form_error('where_hrdf');?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				
				<div class="col-md-5">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Still registered or not?');?><span class="required">*</span></label>
					<div class="form-group">
						<div class="make-switch" data-on-label="Y" data-off-label="N">
							<input type="checkbox" name="hrdf_still_registered" id="hrdf_still_registered" class="toggle"/>
							
						</div>
					</div>	
				</div>
				<div class="col-md-offset-2 col-md-5"> </div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>