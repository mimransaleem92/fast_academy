<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>
<style>
 .datemask { }
</style>
	
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-reorder"></i><?php echo Base_Controller::ToggleLang('Student Info');?></div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php $today = date('Y-m-d'); echo form_open('students/add',array('id'=>'mainForm', 'class'=>"form-horizontal")); ?>
		<!-- <form action="#" id="mainForm" class="form-horizontal" method="post"> -->	
			<div class="form-body">
				<div class="alert alert-danger display-hide">
					<button class="close" data-close="alert"></button>
					You have some form errors. Please check below.
				</div>
				<div class="alert alert-success display-hide">
					<button class="close" data-close="alert"></button>
					Your form validation is successful!
				</div>
				<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Personal Details');?></h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Admission No');?>:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" readonly="readonly" id="admission_number" name="admission_number" value='<?php echo $new_adminition_no;?>' placeholder="<?php echo Base_Controller::ToggleLang('Admission No');?>">
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4" nowrap="nowrap"><?php echo Base_Controller::ToggleLang('Admission Date');?>:<span class="required">*</span></label>
							<div class="col-md-8">
								<input type="text" class="form-control form-control-inline date-picker"  data-date-format="dd-mm-yyyy" size="16" id="admission_date" name="admission_date" value='<?php echo Util::dateDisplayFormate( $today);?>' />
								<!-- <span class="help-block">This field has error.</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Course').' / '. Base_Controller::ToggleLang('Section');?>:<span class="required">*</span></label>
							<div class="col-md-6">
								<select name="course_id" class="form-control" id="course_id" data-placeholder="Choose a Course" tabindex="1" > <!-- onchange="onchange_courses(this.value)"> -->
				                    <option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
				                    <?php foreach($courses_list as $course){ 
				                    	$course_id = $course->course_id;
				                    	?> 
				                    	<option value="<?php echo $course_id;?>" <?php if(isset($_POST['course_id']) && $_POST['course_id'] == $course_id) echo 'selected';?> ><?php echo $course->course_name;?></option>
				                    <?php } ?>
								</select>
								<span class="has-error"><?php echo form_error('course_id');?></span>
							</div>
							<div class="col-md-3">
								<select name="section" class="form-control" id="section" data-placeholder="Choose a section" tabindex="1" >
				                    <option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
				                    <option value="A" <?php if(isset($_POST['section']) && $_POST['section'] == 'A') echo 'selected';?> > A </option>
				                    <option value="B" <?php if(isset($_POST['section']) && $_POST['section'] == 'B') echo 'selected';?> > B </option>
				                    <option value="C" <?php if(isset($_POST['section']) && $_POST['section'] == 'C') echo 'selected';?> > C </option>
				                    <option value="D" <?php if(isset($_POST['section']) && $_POST['section'] == 'D') echo 'selected';?> > D </option>
				                    <option value="E" <?php if(isset($_POST['section']) && $_POST['section'] == 'E') echo 'selected';?> > E </option>
	                                <option value="F" <?php if(isset($_POST['section']) && $_POST['section'] == 'F') echo 'selected';?>> F </option>
				                    <option value="G" <?php if(isset($_POST['section']) && $_POST['section'] == 'G') echo 'selected';?>> G </option>
				                    <option value="H" <?php if(isset($_POST['section']) && $_POST['section'] == 'H') echo 'selected';?>> H </option>
				                    <option value="I" <?php if(isset($_POST['section']) && $_POST['section'] == 'I') echo 'selected';?>> I </option>
								</select>
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Session').' / '.Base_Controller::ToggleLang('Term');?>:<span class="required">*</span></label>
							<div class="col-md-4" id="td_batch">
								<select id="batch_id" name="batch_id" class="form-control" data-placeholder="Choose a Session" tabindex="1">
									<option value="">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
									<?php 
										if(isset($batch_list) && sizeof($batch_list)>0){ $i = 0; $count = sizeof($batch_list); 
										foreach($batch_list as $batch){ $i++;
										$batch_id = $batch->batch_id;
										$select = '';
										if(isset($_POST['batch_id']) && $_POST['batch_id'] == $batch_id) $select = 'selected';
										else if( $i == $count ) $select = 'selected';
										?> 
											<option value="<?php echo $batch_id;?>" <?php echo $select; ?> ><?php echo $batch->batch_name;?></option>
										<?php }
										} ?>
								</select>
							</div>
							<?php $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');?>
							<div class="col-md-4">
								<select name="admission_term" class="form-control" id="admission_term" data-placeholder="Choose a fee term" tabindex="1" >
				                    <?php // value of fee term is made by concate first digit from the division of the student like DIS=2 or DNS=1 
									if($div_id == '2'){	
									?>
				                    <option value="21" selected="selected"> 1st Term </option>
				                    <option value="22"> 2nd Term </option>
				                    <option value="23"> 3rd Term </option>
				                    <option value="24"> 4th Term </option>
				                    <?php } else {?>
				                    <option value="11" selected="selected"> 1st Term </option>
				                    <option value="12"> 2nd Term </option>
				                    <?php }?>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('First Name');?>:<span class="required">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" data-required="1" id="first_name" name="first_name" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>" placeholder="<?php echo Base_Controller::ToggleLang('First Name');?>" onblur="document.getElementById('student_name').value = this.value + ' ' + document.getElementById('last_name').value " />
								<span class="has-error"><?php echo form_error('first_name');?></span>
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Last Name');?>:<span class="required">*</span></label>
							<div class="col-md-8">
								<input type="text" class="form-control" data-required="1" id="last_name" name="last_name" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; ?>" placeholder="<?php echo Base_Controller::ToggleLang('Last Name');?>" onblur="document.getElementById('student_name').value = document.getElementById('first_name').value + ' ' + this.value" />
								<input type="hidden" id="student_name" name="student_name" value="" />
								<span class="has-error"><?php echo form_error('last_name');?></span>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('ID Number');?>:<span class="required">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" data-required="1"  name="iqama_id" id="iqama_id" maxlength="10" value="<?php if(isset($_POST['iqama_id'])) echo $_POST['iqama_id']; ?>" placeholder="<?php echo Base_Controller::ToggleLang('ID Number');?>"/>
								<span class="has-error"><?php echo form_error('iqama_id');?></span>
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Gender');?>:</label>
							<div class="col-md-8">
								<select class="form-control" name="gender" id='gender'>
									<option value=""><?php echo Base_Controller::ToggleLang('Male');?></option>
									<option value=""><?php echo Base_Controller::ToggleLang('Female');?></option>
								</select>
								<!--<span class="help-block">Select your gender.</span>-->
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Issue Date');?>:</label>
							<div class="col-md-9">
								<input type="text" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" name="issue_date" id="issue_date" maxlength="10" value="<?php if(isset($_POST['issue_date'])) echo Util::displayFormat($_POST['issue_date']); ?>" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Expiry Date');?>:<span class="required">*</span></label>
							<div class="col-md-8">
								<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" name="iqama_expiry" id="iqama_expiry" maxlength="10" value="<?php if(isset($_POST['iqama_expiry'])) echo Util::displayFormat($_POST['iqama_expiry']); ?>" />
								<span class="has-error"><?php echo form_error('iqama_expiry');?></span>
							</div>
						</div>
					</div>
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Passport #');?>:</label>
							<div class="col-md-9">
								<input type="text" class="form-control form-control-inline" size="10" name="passport_id" id="passport_id" maxlength="10" value="<?php if(isset($_POST['passport_id'])) echo $_POST['passport_id']; ?>" />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Expiry Date');?>:</label>
							<div class="col-md-8">
								<input type="text" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" name="passport_expiry" id="passport_expiry" maxlength="10" value='<?php if(isset($_POST['passport_expiry'])) echo Util::displayFormat($_POST['passport_expiry']); ?>' />
							</div>
						</div>
					</div>
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6" >
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Sibling');?>:</label>
							<div class="col-md-3">
								<div class="make-switch" data-on-label="Yes" data-off-label="No">
									<!-- if yes discount 10% for this sibling and sibling_student_id must be filled if it is yes-->
									<input type="checkbox" name="sibling" id="sibling" onchange="onchange_sibling(this)" class="toggle"/>
								</div>
							</div>
							<div class="col-md-6">
								<input class="form-control" disabled="disabled" name="sibling_student_id" id="sibling_student_id" value="<?php if(isset($_POST['sibling_student_id'])) echo $_POST['sibling_student_id']; ?>" placeholder="Link Student"/>
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6" >
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Employee Son');?>:</label>
							<div class="col-md-3">
								<div class="make-switch" data-on-label="Yes" data-off-label="No">
									<input type="checkbox" name="employee_kid" id="employee_kid" onchange="onchange_employee_kid(this)" class="toggle"/>
								</div>
							</div>
							<div class="col-md-5">
								<input class="form-control" disabled="disabled" name="discount_on_employee_kid" id="discount_on_employee_kid" maxlength="2" style="text-align: right;" value="<?php if(isset($_POST['discount_on_employee_kid'])) echo $_POST['discount_on_employee_kid']; ?>" placeholder="Percent"/>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<!-- For DIS transport and edu plus not available -->
				<div class="row" style="<?php if($div_id == '2') echo 'display:none';?>">
					<div class="col-md-6" >
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Transportation');?>:</label>
							<div class="col-md-3">
								<div class="make-switch" data-on-label="Yes" data-off-label="No">
									<!-- avail transportation -->
									<input type="checkbox" name="transportation" id="transportation" onchange="onchange_transport(this)" class="toggle"/>
								</div>
							</div>
							<div class="col-md-6">
								<select class="form-control" disabled="disabled" name="transport_type" id="transport_type" />
									<option value="TRANSPORT_FEE" > One Way </option>
									<option selected value="TRANSPORT_FEE_2WAY" > Two Way </option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-6" >
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Education Plus');?>:</label>
							<div class="col-md-3">
								<div class="make-switch" data-on-label="Yes" data-off-label="No">
									<!-- avail transportation -->
									<input type="checkbox" name="education_plus" id="education_plus" onchange="onchange_education_plus(this)" class="toggle"/>
								</div>
							</div>
							<div class="col-md-5">
								<input class="form-control" disabled="disabled" name="education_plus_fee" id="education_plus_fee" maxlength="4" style="text-align: right;" value="<?php if(isset($_POST['education_plus_fee'])) echo $_POST['education_plus_fee']; ?>" placeholder="0.00"/>
							</div>
						</div>
					</div>
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Blood Group');?>:</label>
							<div class="col-md-9">
								<select name="blood_group" id="blood_group" class="form-control" tabindex="1">
									<option value="">Unknown</option>
									<option value="A+">A+</option>
									<option value="A-">A-</option>
									<option value="B+">B+</option>
									<option value="B-">B-</option>
									<option value="O+">O+</option>
									<option value="O-">O-</option>
									<option value="AB+">AB+</option>
									<option value="AB-">AB-</option>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Date of Birth');?>:</label>
							<div class="col-md-8">
								<input type="text" name="date_of_birth" id="date_of_birth" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="16" placeholder="dd-mm-yyyy" value="<?php if(isset($_POST['date_of_birth'])) echo Util::displayFormat($_POST['date_of_birth']); ?>"/>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Religion');?>:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="religion" id="religion"  value='<?php if(isset($_POST['religion'])) echo $_POST['religion']; ?>' placeholder="Religion"/>
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Nationality');?>:</label>
							<div class="col-md-8">
								<select name="nationality" class="form-control" id="nationality" >
									<?php foreach($country_list as $country){ 
										$country_id = $country->id;
										?> 
										<option value="<?php echo $country_id;?>" <?php if($country_id ==  '162') echo 'selected'; ?> ><?php if($lang == 'ar') echo $country->country_ar; else echo $country->country_name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Language');?>:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="language" id="language" value='<?php if(isset($_POST['language'])) echo $_POST['language']; ?>' placeholder="<?php echo Base_Controller::ToggleLang('Language');?>" />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Birth Place');?>:</label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="birth_place" id="birth_place" maxlength="14" value='<?php if(isset($_POST['birth_place'])) echo $_POST['birth_place']; ?>' placeholder="<?php echo Base_Controller::ToggleLang('Birth Place');?>" />
								<!-- <span class="help-block">This field has error.</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Parent Details');?></h3>
				<!--/row-->                   
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Father Name');?><span class="required">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" data-required="1" name="father_name" id="father_name" value="<?php if(isset($_POST['father_name'])) echo $_POST['father_name']; ?>" >
								<span class="help-block">As shown in Passport.</span><span class="has-error"><?php echo form_error('father_name');?></span>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Mother Name');?></label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="mother_name" id="mother_name" value='<?php if(isset($_POST['mother_name'])) echo $_POST['mother_name']; ?>' >
								<span class="help-block">As shown in Passport.</span>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Work Place');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="work_place_father" id="work_place_father" value='<?php if(isset($_POST['work_place_father'])) echo $_POST['work_place_father']; ?>'> 
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Work Place');?></label>
							<div class="col-md-8">
								<input type="text"  class="form-control" name="work_place_mother" id="work_place_mother" value='<?php if(isset($_POST['work_place_mother'])) echo $_POST['work_place_mother']; ?>'> 
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->           
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('ID Number');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" maxlength="10" name="id_number_father" id="id_number_father" value='<?php if(isset($_POST['id_number_father'])) echo $_POST['id_number_father']; ?>'> 
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('ID Number');?></label>
							<div class="col-md-8">
								<input type="text" class="form-control" maxlength="10" name="id_number_mother" id="id_number_mother" value='<?php if(isset($_POST['id_number_mother'])) echo $_POST['id_number_mother']; ?>'>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Work Phone');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" maxlength="20" name="work_phone_father" id="work_phone_father" value='<?php if(isset($_POST['work_phone_father'])) echo $_POST['work_phone_father']; ?>' /> 
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Work Phone');?></label>
							<div class="col-md-8">
								<input type="text" class="form-control" maxlength="20" name="work_phone_mother" id="work_phone_mother" value='<?php if(isset($_POST['work_phone_mother'])) echo $_POST['work_phone_mother']; ?>' />
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Cell Phone');?><span class="required">*</span></label>
							<div class="col-md-9">
								<input type="text" data-required="1" maxlength="20" class="form-control" name="cell_phone_father" id="cell_phone_father" value="<?php if(isset($_POST['cell_phone_father'])) echo $_POST['cell_phone_father']; ?>" />
								<span class="has-error"><?php echo form_error('cell_phone_father');?></span> 
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Cell Phone');?></label>
							<div class="col-md-8">
								<input type="text" class="form-control" maxlength="20" name="cell_phone_mother" id="cell_phone_mother" value="<?php if(isset($_POST['cell_phone_mother'])) echo $_POST['cell_phone_mother']; ?>" />
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Email');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="email_father" id="email_father" value='<?php if(isset($_POST['email_father'])) echo $_POST['email_father']; ?>' /> 
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Email');?></label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="email_mother" id="email_mother" value='<?php if(isset($_POST['email_mother'])) echo $_POST['email_mother']; ?>' />
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Contact Details');?></h3>
				<!--/row-->                   
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Address Line1');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="address_line1" id="address_line1" value="<?php if(isset($_POST['address_line1'])) echo $_POST['address_line1']; ?>">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Address Line2');?></label>
							<div class="col-md-8">
								<input type="text" class="form-control" name="address_line2" id="address_line2" value='<?php if(isset($_POST['address_line2'])) echo $_POST['address_line2']; ?>' >
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('City / Town');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="city" id="city" value='<?php if(isset($_POST['city'])) echo $_POST['city']; ?>'> 
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('State / Province');?></label>
							<div class="col-md-8">
								<input type="text"  class="form-control" name="state" id="state" value='<?php if(isset($_POST['state'])) echo $_POST['state']; ?>'> 
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->           
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Email');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="email" id="email" value='<?php if(isset($_POST['email'])) echo $_POST['email']; ?>' />
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Country');?></label>
							<div class="col-md-8">
								<select class="form-control" name="country_id" id="country_id">
									<?php foreach($country_list as $country){ 
										$country_id = $country->id;
										?> 
										<option value="<?php echo $country_id;?>" <?php if($country_id ==  '162') echo 'selected'; ?> ><?php if($lang == 'ar') echo $country->country_ar; else echo $country->country_name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
			</div>
			<div class="form-actions fluid">
				<div class="row">
					<div class="col-md-6">
						<div class="col-md-offset-3 col-md-9">
							<button type="button" class="btn green" onclick="submitForm()" ><i class="fa fa-check"></i> <?php echo Base_Controller::ToggleLang('Submit');?></button>
							<button type="button" class="btn default" onclick="window.open('<?php echo base_url().$model;?>', '_self')" ><?php echo Base_Controller::ToggleLang('Cancel');?></button>                              
						</div>
					</div>
					<div class="col-md-6"></div>
				</div>
			</div>
		<?php echo form_close();?>
		<!-- </form> -->
		<!-- END FORM-->                
	</div>
</div>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>	
		<script> 
			jQuery(document).ready(function() {    
			   // initiate layout and plugins
			   App.init();
			   if (jQuery().datepicker) {
		           $('.date-picker').datepicker({
		           	dateFormat: "dd-mm-yy",
		               rtl: App.isRTL(),
		               autoclose: true
		           });
		           $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
		       }

			   var form1 = $('#mainForm');
	           var error1 = $('.alert-danger', form1);
	           var success1 = $('.alert-success', form1);

	            form1.validate({
	                errorElement: 'span', //default input error message container
	                errorClass: 'help-block', // default input error message class
	                focusInvalid: false, // do not focus the last invalid input
	                ignore: "",
	                rules: {
	                    first_name: {
	                        minlength: 2,
	                        required: true
	                    },
	                    last_name: {
	                        minlength: 2,
	                        required: true
	                    },
	                    iqama_id: { required: true},
	                    iqama_expiry: { required: true },
	                    email_father: { email: true },
	                    email_mother: { email: true },
	                    cell_phone_father: { required: true, number: true },
	                    cell_phone_mother: { required: true, digits: true }
	                },
	                invalidHandler: function (event, validator) { //display error alert on form submit              
	                    success1.hide();
	                    error1.show();
	                    App.scrollTo(error1, -200);
	                },
	                highlight: function (element) { // hightlight error inputs
	                    $(element)
	                        .closest('.form-group').addClass('has-error'); // set error class to the control group
	                },
	                unhighlight: function (element) { // revert the change done by hightlight
	                    $(element)
	                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
	                },
	                success: function (label) {
	                    label
	                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
	                },
	                submitHandler: function (form) {
	                    success1.show();
	                    error1.hide();
	                }
	            });
			});
		
	        function onchange_courses(val){
		        if(val != ''){
	        		get('<?php echo base_url().'students/batches/';?>'+val, '', 'td_batch','false','');
		        }
	        }

	        function onchange_sibling(obj){
	        	document.getElementById('sibling_student_id').disabled = true;
		        if(obj.checked){
		        	
		        	document.getElementById('sibling_student_id').disabled = false;
		        	document.getElementById('sibling_student_id').focus();
		        }
	        }
	        
	        function onchange_employee_kid(obj){
	        	document.getElementById('discount_on_employee_kid').disabled = true;
		        if(obj.checked){
		        	document.getElementById('discount_on_employee_kid').value = 0;
		        	document.getElementById('discount_on_employee_kid').disabled = false;
		        	document.getElementById('discount_on_employee_kid').focus();
		        }
	        }

        	function onchange_transport(obj){
    	    	document.getElementById('transport_type').disabled = true;
    		    if(obj.checked){
    		    	document.getElementById('transport_type').selectedIndex = 1;
    		        document.getElementById('transport_type').disabled = false;
    		        document.getElementById('transport_type').focus();
    		  	}
    	  	}

    	  	function onchange_education_plus(obj){
    	  		
    		    if(obj.checked){
    		    	document.getElementById('education_plus_fee').disabled = false;
    		        document.getElementById('education_plus_fee').focus();
    		  	}
    		    else{
    		    	document.getElementById('education_plus_fee').value = '0.00';
    		    	document.getElementById('education_plus_fee').disabled = true;
    		    }
    	  	}
	        
        </script> 
		