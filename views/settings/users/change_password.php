
			<div class="row">
				<div class="col-md-12">
				<!-- BEGIN FORM-->
				<?php echo form_open('user/update_password',array('id'=>'mainForm', 'class'=>"form-horizontal")); ?>
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							<?php echo Base_Controller::ToggleLang('You have some form errors. Please check below');?>
						</div>
						<div class="form-group">
							<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('User Name');?>:</label>
							<label  class="col-md-4 control-label-left" style="padding-top: 8px"><?php echo $this->session->userdata('stc_user_name')?></label>
						</div>
						
						<div class="form-group password-strength">
							<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Old Password');?>: <span class="required">*</span></label>
							<div class="col-md-4">
								<div class="form-group">
									<input type="hidden" name="name" value="<?php echo $this->session->userdata(SESSION_CONST_PRE.'userId')?>">
									<input type="password" name="password" id="password_strength" data-required="1" class="form-control" placeholder="Password">
								</div>
							</div>
						</div>
						<div class="form-group password-strength">
							<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('New Password');?>: <span class="required">*</span></label>
							<div class="col-md-4">
								<div class="form-group">
										<input type="password" name="new_password" id="password_strength" data-required="1" class="form-control" placeholder="Password">
								</div>
							</div>
						</div>
						<div class="form-group password-strength">
							<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Confirm Password');?>: <span class="required">*</span></label>
							<div class="col-md-4">
								<div class="form-group">
										<input type="password" name="confirm_password" id="password_strength" data-required="1" class="form-control" placeholder="Password">
								</div>
							</div>
						</div>
						
					</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-3 col-md-9">
							<!-- <button type="submit" class="btn blue" data-dismiss="modal">Submit</button>-->
							<button type="button" class="btn blue" onclick="submitForm()" ><i class="fa fa-check"></i> <?php echo Base_Controller::ToggleLang('Update');?></button>
							<button type="button" class="btn default" onclick="window.open('<?php echo base_url().$model;?>', '_self')" ><?php echo Base_Controller::ToggleLang('Cancel');?></button>                              
						</div>
					</div>
				<?php echo form_close();?>
				<!-- END FORM-->
				</div>
			</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js" type="text/javascript" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/scripts/form-validation.js"></script> 
<script>
		jQuery(document).ready(function() { 
			App.init();	
			FormValidation.init();
			
			var initialized = false;
			var input = $("#password_strength");

			input.keydown(function () {
				if (initialized === false) {
					// set base options
					input.pwstrength({
						raisePower: 1.4,
						minChar: 8,
						verdicts: ["Weak", "Normal", "Medium", "Strong", "Very Strong"],
						scores: [17, 26, 40, 50, 60]
					});

					// add your own rule to calculate the password strength
					input.pwstrength("addRule", "demoRule", function (options, word, score) {
						return word.match(/[a-z].[0-9]/) && score;
					}, 10, true);

					// set as initialized 
					initialized = true;
				}
			});
			
		});
</script>
