
			<div class="row">
				<div class="col-md-12">
				<!-- BEGIN FORM-->
				<?php echo form_open('user_profile/update_password',array('id'=>'mainForm', 'class'=>"form-horizontal")); ?>
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							<?php echo Base_Controller::ToggleLang('You have some form errors. Please check below');?>
						</div>
						<div class="form-group">
							<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('User Name');?>:</label>
							<label  class="col-md-4 control-label-left" style="padding-top: 8px"><?php echo $this->session->userdata(SESSION_CONST_PRE.'user_name')?></label>
						</div>
						
						<div class="form-group password-strength">
							<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Old Password');?>: <span class="required">*</span></label>
							<div class="col-md-4">
								<div class="form-group">
									<input type="hidden" name="name" value="<?php echo $this->session->userdata(SESSION_CONST_PRE.'userId')?>">
									<input type="password" id="curr_password" name="curr_password" data-required="1" class="form-control" placeholder="Password">
								</div>
							</div>
						</div>
						<div class="form-group password-strength">
							<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('New Password');?>: <span class="required">*</span></label>
							<div class="col-md-4">
								<div class="form-group">
										<input type="password" name="new_password" id="new_password" data-required="1" class="form-control" placeholder="Password">
								</div>
							</div>
						</div>
						<div class="form-group password-strength">
							<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Confirm Password');?>: <span class="required">*</span></label>
							<div class="col-md-4">
								<div class="form-group">
										<input type="password" name="confirm_password" id="confirm_password" data-required="1" class="form-control" placeholder="Password">
								</div>
							</div>
						</div>
						
					</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-3 col-md-9">
							<!-- <button type="submit" class="btn blue" data-dismiss="modal">Submit</button>-->
							<button type="button" class="btn blue" onclick="validate_form()" ><i class="fa fa-check"></i> <?php echo Base_Controller::ToggleLang('Update');?></button>
							<button type="button" class="btn default" onclick="window.open('<?php echo base_url();?>dashboard', '_self')" ><?php echo Base_Controller::ToggleLang('Cancel');?></button>                              
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
			
		});
		
		function validate_form(){
			var current_password = document.getElementById('curr_password').value;
			var new_password = document.getElementById('new_password').value;
			var confirm_password = document.getElementById('confirm_password').value;
			
			if( confirm_password != new_password) {
				
				document.getElementById('new_password').value = '';
				document.getElementById('confirm_password').value = '';
				alert('Password was not macthed. Please Re-enter!!');
			}
			else if(new_password == '' || confirm_password == '' || current_password == ''){
				alert('Please enter password. All fields are required!');
			}
			else if(new_password != '' && confirm_password != ''){
			   submitForm();
			}
		}
</script>
