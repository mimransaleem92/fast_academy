<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/jquery-multi-select/css/multi-select-rtl.css" />

<div class="col-md-12">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('New User');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<!-- BEGIN FORM-->
			<?php echo form_open('user/add',array('id'=>'mainForm', 'class'=>"form-horizontal")); 
				echo form_hidden("role_id", '2');
				echo form_hidden("company_id", $this->session->userdata(SESSION_CONST_PRE.'company_id')); ?>
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
								<input type="text" name="name" data-required="1" class="form-control" placeholder="Enter Name" value="<?php echo set_value('name');?>" >
								<span class="help-block"><?php echo form_error('name');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Arabic Name</label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="arabic_name" class="form-control" placeholder="Enter Arabic Name">
								<span class="help-block"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">User Name<span class="required">*</span></label>
						<div class="col-md-4">
							<div class="form-group">
							<input type="text" name="username" data-required="1" class="form-control" placeholder="Enter Username" value="<?php echo set_value('username');?>">
							<span class="help-block"><?php echo form_error('username');?></span>
							</div>
						</div>
					</div>
					<div class="form-group password-strength">
						<label  class="col-md-3 control-label">Password<span class="required">*</span></label>
						<div class="col-md-4">
							<div class="form-group">
									<input type="password" name="password" id="pwstrength" data-required="1" class="form-control" placeholder="Password">
									<span class="help-block"><?php echo form_error('password');?></span>
							</div>
						</div>
					</div>
					<?php /*  
					<div class="form-group">
						<label  class="col-md-3 control-label">Branch</label>
						<div class="col-md-4">
							<div class="form-group">
								<select  class="form-control" name="division_id">
									<?php foreach($division_list as $div){ 
										$div_id = $div->division_id;
										?> 
										<option value="<?php echo $div_id;?>" <?php if($div_id ==  $this->session->userdata(SESSION_CONST_PRE.'division_id')) echo 'selected'; ?> ><?php echo $div->name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>*/?>
					<div class="form-group">
						<label  class="col-md-3 control-label">Status</label>
						<div class="col-md-4">
							<div class="form-group">
								<div class="input-group">
									<div data-toggle="buttons" class="btn-group">
										<label class="btn blue active">
										<input type="radio" class="toggle" name="is_active" id="active_y" checked="checked" value="Y"> Active
										</label>
										<label class="btn blue">
										<input type="radio" class="toggle" name="is_active" id="active_n" value="N"> Inactive
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="form-group">
						<label class="control-label col-md-3">Default Language</label>
						<div class="col-md-4">
							<select class="form-control" id="default_language" name="default_language">
								<option value="en" selected ><?php echo 'English';?></option>
			                    <option value="ar"><?php echo 'Arabic';?></option>
							</select>
						</div>
					</div> -->
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
											$sel = ($course_id ==  $c) ?  'selected' : '' ;
											echo '<option value="'.$course_id.'" '.$sel.'>'.$course->course_name.'</option>';
										}
										echo '</select>';
										?>
										<select name="section" class="form-control col-md-4" id="section" tabindex="1" style="width: 100px" >
						                    <option value="" selected><?php echo Base_Controller::ToggleLang('Section'); ?></option>
						                    <option value="A" > A </option>
						                    <option value="B" > B </option>
						                    <option value="C" > C </option>
						                    <option value="D" > D </option>
						                    <option value="E" > E </option>
						                    <option value="F" > F </option>
						                    <option value="G" > G </option>
						                    <option value="H" > H </option>
						                    <option value="I" > I </option>
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
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Home Page');?></label>
						<div class="col-md-2">
							<div class="form-group">
								<select name="default_screen" class="form-control" id="default_screen">
									<option value="dashboard" ><?php echo Base_Controller::ToggleLang('Dashboard');?></option>
			                    		<option value="students" selected="selected" ><?php echo Base_Controller::ToggleLang('Students');?></option>
								</select>
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
	</div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/scripts/form-validation.js"></script> 
<script>
		jQuery(document).ready(function() {
			App.init();	
			
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