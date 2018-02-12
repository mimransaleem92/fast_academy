<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/jquery-multi-select/css/multi-select.css" />

<div class="col-md-12">
	<!-- BEGIN FORM-->
	<?php  
		    $form = $form[0];
		    echo form_open('user/update',array('id'=>'mainForm', 'class'=>"form-horizontal"));
		    echo form_hidden("user_id",$form->user_id);
		    echo form_hidden("company_id", $form->company_id);
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
				<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Name');?><span class="required">*</span></label>
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" name="name" data-required="1" class="form-control" placeholder="Enter Name" value="<?php echo $form->name;?>">
						<span class="help-block"></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Arabic Name');?></label>
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" name="arabic_name" class="form-control" placeholder="Enter Arabic Name" value="<?php echo $form->arabic_name;?>">
						<span class="help-block"></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('User Name');?><span class="required">*</span></label>
				<div class="col-md-4">
					<div class="form-group">
					<input type="text" name="username" data-required="1" class="form-control" placeholder="Enter Username" value="<?php echo $form->username;?>">
					</div>
				</div>
			</div>
			<div class="form-group password-strength">
				<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Password');?><span class="required">*</span></label>
				<div class="col-md-4">
					<div class="form-group">
							<input type="password" name="password" id="password_strength" data-required="1" class="form-control" placeholder="Password" value="<?php echo $form->password;?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Branch');?></label>
				<div class="col-md-3">
					<div class="form-group">
						<select  class="form-control" name="division_id" >
							<?php foreach($division_list as $div){ 
								$div_id = $div->division_id;
								?> 
								<option value="<?php echo $div_id;?>" <?php if($div_id ==  $form->division_id) echo 'selected'; else echo 'disabled="disabled"'; ?> ><?php echo $div->name;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Show Both Branch');?></label>
				<div class="col-md-4">
					<div class="form-group">
						<div class="input-group">
							<div data-toggle="buttons" class="btn-group">
								<label class="btn blue <?php if($form->both_division == 'Y') echo 'active';?>">
								<input type="radio" class="toggle" name="both_division" id="both_division_y" <?php if($form->both_division == 'Y') echo 'checked="checked"';?> value="Y"> <?php echo Base_Controller::ToggleLang('Yes');?>
								</label>
								<label class="btn blue <?php if($form->both_division == 'N') echo 'active';?>">
								<input type="radio" class="toggle" name="both_division" id="both_division_n" <?php if($form->both_division == 'N') echo 'checked="checked"';?> value="N"> <?php echo Base_Controller::ToggleLang('No');?>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Status');?></label>
				<div class="col-md-4">
					<div class="form-group">
						<div class="input-group">
							<div data-toggle="buttons" class="btn-group">
								<label class="btn blue <?php if($form->is_active == 'Y') echo 'active';?>">
								<input type="radio" class="toggle" name="is_active" id="active_y" <?php if($form->is_active == 'Y') echo 'checked="checked"';?> value="Y"> <?php echo Base_Controller::ToggleLang('Active');?>
								</label>
								<label class="btn blue <?php if($form->is_active == 'N') echo 'active';?>">
								<input type="radio" class="toggle" name="is_active" id="active_n" <?php if($form->is_active == 'N') echo 'checked="checked"';?> value="N"> <?php echo Base_Controller::ToggleLang('Inactive');?>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Action Assigned');?></label>
				<div class="col-md-3">
					<div class="form-group">
						<select name="admin_role" class="form-control" id="admin_role" tabindex="1" >
		                    <option value="1" <?php if($form->admin_role == '1') echo 'selected';?> > <?php echo Base_Controller::ToggleLang('Add Record');?> </option>
		                    <option value="2" <?php if($form->admin_role == '2') echo 'selected';?> > <?php echo Base_Controller::ToggleLang('Add & Update');?> </option>
		                    <option value="3" <?php if($form->admin_role == '3') echo 'selected';?> > <?php echo Base_Controller::ToggleLang('Add Update & Delete');?> </option>
		                    <option value="0" <?php if($form->admin_role == '0') echo 'selected';?> > <?php echo Base_Controller::ToggleLang('Readonly Access');?></option>
		                </select>
						<?php /*?>
						<div class="input-group">
							<div data-toggle="buttons" class="btn-group">
								<label class="btn blue <?php if($form->admin_role == '1') echo 'active';?>">
								<input type="radio" class="toggle" name="admin_role" id="active_y" <?php if($form->admin_role == '1') echo 'checked="checked"';?> value="1"> Enable
								</label>
								<label class="btn blue <?php if($form->admin_role == '0') echo 'active';?>">
								<input type="radio" class="toggle" name="admin_role" id="active_n" <?php if($form->admin_role == '0') echo 'checked="checked"';?> value="0"> Disable
								</label>
							</div>
						</div><? */ ?>
					</div>
				</div>
			</div>
			<!-- <div class="form-group">
				<label class="control-label col-md-3">Default Language</label>
				<div class="col-md-4">
					<select class="form-control" id="default_language" name="default_language">
						<option value="en" <?php if($form->default_language === 'en') echo 'selected'?>><?php echo 'English';?></option>
	                    <option value="ar" <?php if($form->default_language === 'ar') echo 'selected'?>><?php echo 'Arabic';?></option>
					</select>
				</div>
			</div>-->
			<div class="form-group">
				<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('User Role');?></label>
				<div class="col-md-3">
					<div class="form-group">
						<select name="default_role" class="form-control" id="default_role" tabindex="1" >
		                    <option value="1" <?php if($form->default_role == '1') echo 'selected';?> > <?php echo Base_Controller::ToggleLang('Admin');?> </option>
		                    <option value="2" <?php if($form->default_role == '2') echo 'selected';?> > <?php echo Base_Controller::ToggleLang('Teacher');?> </option>
		            
		                </select>
		        	</div>
				</div>
			</div>
			<?php /* <div class="form-group">
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
			</div> */?>
			<div class="form-group">
				<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Home Page');?></label>
				<div class="col-md-2">
					<div class="form-group">
						<select name="default_screen" class="form-control" id="default_screen">
							<option value="dashboard" <?php if($form->default_screen == 'dashboard') echo 'selected'?> ><?php echo Base_Controller::ToggleLang('Dashboard');?></option>
                    		<option value="students" <?php if($form->default_screen == 'students') echo 'selected'?> ><?php echo Base_Controller::ToggleLang('Students');?></option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Class Incharge');?></label>
				<div class="col-md-2">
					<div class="form-group">
						<select name="employee_id" class="form-control select2me" id="employee_id" >
		                    <option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
		                    <?php foreach($employee_list as $emp){ 
		                    		$employee_id = $emp->employee_id;
		                    		$s = ($employee_id == $form->employee_id) ? 'selected' : '';
		                    	?> 
		                    	<option value=<?php echo '"'.$employee_id.'" '.$s;?> ><?php echo $emp->employee_name;?></option>
		                    <?php } ?>
						</select>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Class').' / '.Base_Controller::ToggleLang('Section');?></label>
				<div class="col-md-4">
					<div class="form-group">
						<?php 
							$b = isset($_POST['batch_id']) ? $_POST['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
							$c = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
							$sec = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
							$admin_user = true;
    						if($admin_user){
    							echo '<select name="course_id" class="form-control col-md-6" id="course_id" style="width: 150px" >';
    							foreach($courses_list as $course){ 
									$course_id = $course->course_id; if($course_id > 15) continue; 
									$sel = ($course_id ==  $form->course_id) ?  'selected' : '' ;
									echo '<option value="'.$course_id.'" '.$sel.'>'.$course->course_name.'</option>';
								}
								echo '</select>';
								?>
								<select name="section" class="form-control col-md-4" id="section" tabindex="1" style="width: 100px" >
				                    <option value="" selected><?php echo Base_Controller::ToggleLang('Section'); ?></option>
				                    <option value="A" <?php if($form->section == 'A') echo 'selected';?> > A </option>
				                    <option value="B" <?php if($form->section == 'B') echo 'selected';?> > B </option>
				                    <option value="C" <?php if($form->section == 'C') echo 'selected';?> > C </option>
				                    <option value="D" <?php if($form->section == 'D') echo 'selected';?> > D </option>
				                    <option value="E" <?php if($form->section == 'E') echo 'selected';?> > E </option>
				                    <option value="F" <?php if($form->section == 'F') echo 'selected';?> > F </option>
				                    <option value="G" <?php if($form->section == 'G') echo 'selected';?> > G </option>
				                    <option value="H" <?php if($form->section == 'H') echo 'selected';?> > H </option>
				                    <option value="I" <?php if($form->section == 'I') echo 'selected';?> > I </option>
								</select>
								<?
							}
							else
							{
								foreach($courses_list as $course){
									$course_id = $course->course_id;
									if($course_id ==  $c) { $course_name = $course->course_name; break;}
								}
						?>
    						<input type="hidden" name="course_id" id="course_id" value="<?php echo $c; ?>">
    						<input type="text" name="course_name" readonly="readonly" class="form-control col-md-6" id="course_name" value="<?php echo $course_name; ?>" style="width: 150px">
    				<?php 	} ?>
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
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
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

          
	                