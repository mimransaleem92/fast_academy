<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/jquery-multi-select/css/multi-select.css" />

<div class="col-md-12">
	<!-- BEGIN FORM-->
	<?php  
		    $form = $form[0];
		    echo form_open('user/update',array('id'=>'mainForm', 'class'=>"form-horizontal"));
		    echo form_hidden("user_id",$form->user_id);
	?>
		<div class="form-body">
			<div class="alert alert-danger display-hide">
				<button class="close" data-close="alert"></button>
				You have some form errors. Please check below.
			</div>
			<div class="alert alert-success display-hide">
				<button class="close" data-close="alert"></button>
				Your form validation is successful!
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label">Name<span class="required">*</span></label>
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" name="name" data-required="1" class="form-control" placeholder="Enter Name" value="<?php echo $form->name;?>">
						<span class="help-block"></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label">Arabic Name</label>
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" name="arabic_name" class="form-control" placeholder="Enter Arabic Name" value="<?php echo $form->arabic_name;?>">
						<span class="help-block"></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label">User Name<span class="required">*</span></label>
				<div class="col-md-4">
					<div class="form-group">
					<input type="text" name="username" data-required="1" class="form-control" placeholder="Enter Username" value="<?php echo $form->username;?>">
					</div>
				</div>
			</div>
			<div class="form-group password-strength">
				<label  class="col-md-3 control-label">Password<span class="required">*</span></label>
				<div class="col-md-4">
					<div class="form-group">
							<input type="password" name="password" id="password_strength" data-required="1" class="form-control" placeholder="Password" value="<?php echo $form->password;?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label">Department</label>
				<div class="col-md-4">
					<div class="form-group">
						<select  class="form-control" name="department_id">
							<?php foreach($dept_list as $dept){ 
								$dept_id = $dept->department_id;
								?> 
								<option value="<?php echo $dept_id;?>" <?php if( $dept_id ==  $form->department_id ) echo 'selected'; ?> ><?php echo $dept->name;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label">Status</label>
				<div class="col-md-4">
					<div class="form-group">
						<div class="input-group">
							<div data-toggle="buttons" class="btn-group">
								<label class="btn blue <?php if($form->is_active == '1') echo 'active';?>">
								<input type="radio" class="toggle" name="is_active" id="active" <?php if($form->is_active == '1') echo 'checked="checked"';?> value="Y"> Active
								</label>
								<label class="btn blue <?php if($form->is_active == 'N') echo 'active';?>">
								<input type="radio" class="toggle" name="is_active" id="inactive" <?php if($form->is_active == 'N') echo 'checked="checked"';?> value="N"> Inactive
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Default Language</label>
				<div class="col-md-4">
					<select class="form-control" id="default_language" name="default_language">
						<option value="en" <?php if($form->default_language === 'en') echo 'selected'?>><?php echo 'English';?></option>
	                    <option value="ar" <?php if($form->default_language === 'ar') echo 'selected'?>><?php echo 'Arabic';?></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3">Default</label>
				<div class="col-md-4">
					<select multiple="multiple" class="multi-select" id="availableScreens" name="availableScreens[]">
						<?php 
							$selected_arr = array();
							foreach($selected_scr as $v){
								$selected_arr[] = $v->screen_id;
							}
							foreach($screen_list as $v){ 
	                    	$id = $v->screen_id;
	                    	?> 
	                    	<option value="<?php echo $id;?>" <?php if(in_array($id, $selected_arr)) echo 'selected';?>  ><?php echo $v->name;?></option>
	                    <?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label">Home Page</label>
				<div class="col-md-4">
					<div class="form-group">
						<select name="default_screen" class="form-control" id="default_screen">
							<option value="dashboard" <?php if($form->default_screen === 'dashboard') echo 'selected'?> >Dashboard</option>
	                    			<option value="request" <?php if($form->default_screen === 'request') echo 'selected'?> >Request Form</option>
						</select>
					</div>
				</div>
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
<script src="<?php echo base_url();?>assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js" type="text/javascript" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>

<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/form-validation.js"></script> 
<script>
		jQuery(document).ready(function() { 
			App.init();		
			$('#availableScreens').multiSelect();
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

          
	                