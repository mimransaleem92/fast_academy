<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>
<?php  
    $form = $form[0];
    $name = explode(' ', $form->student_name);
	$today    = date('Y-m-d'); ?>
<div class="tabbable tabbable-custom boxless">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs_0" data-toggle="tab">Student Details</a></li>
		<li><a href="#tabs_1" data-toggle="tab">Parent Details</a></li>
		<li><a href="#tabs_3" data-toggle="tab">Previous Details</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabs_0">	
			<div class="portlet box green">
				<div class="portlet-title">
					<div class="caption"><i class="fa fa-reorder"></i><?php echo Base_Controller::ToggleLang('Student Info');?></div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					<?php echo form_open('students/update',array('id'=>'mainForm', 'class'=>"form-horizontal")); $today = date('Y-m-d'); ?>
						<div class="form-body">
							<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Personal Details');?></h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Admission No');?>:</label>
										<div class="col-md-9">
											<input type="hidden" id="student_id" name="student_id" value='<?php echo $form->student_id;?>' >
											<input type="text" class="form-control" readonly="readonly" id="admission_number" name="admission_number" value='<?php echo $form->admission_number;?>' placeholder="<?php echo Base_Controller::ToggleLang('Admission No');?>">
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Admission Date');?>:</label>
										<div class="col-md-8">
											<input type="text" class="form-control form-control-inline date-picker"  data-date-format="dd-mm-yyyy" size="16" id="admission_date" name="admission_date" value='<?php if($form->admission_date != '0000-00-00') echo Util::dateDisplayFormate( $form->admission_date );?>' />
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
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Course').' / '. Base_Controller::ToggleLang('Section');?>:</label>
										<div class="col-md-6">
											<select name="course_id" class="form-control" id="course_id" data-placeholder="Choose a Course" tabindex="1" > <!-- onchange="onchange_courses(this.value)"> -->
							                    <option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
							                    <?php foreach($courses_list as $course){ 
							                    	$course_id = $course->course_id;
							                    	?> 
							                    	<option value="<?php echo $course_id;?>" <?php if($course_id ==  $form->course_id) echo 'selected'; ?> ><?php echo $course->course_name;?></option>
							                    <?php } ?>
											</select>
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
										<div class="col-md-3">
											<select name="section" class="form-control" id="section" data-placeholder="Choose a section" tabindex="1" >
							                    <option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
							                    <option value="A" <?php if($form->section == 'A') echo 'selected';?>> A </option>
							                    <option value="B" <?php if($form->section == 'B') echo 'selected';?>> B </option>
							                    <option value="C" <?php if($form->section == 'C') echo 'selected';?>> C </option>
							                    <option value="D" <?php if($form->section == 'D') echo 'selected';?>> D </option>
							                    <option value="E" <?php if($form->section == 'E') echo 'selected';?>> E </option>
							                    <option value="F" <?php if($form->section == 'F') echo 'selected';?>> F </option>
							                    <option value="G" <?php if($form->section == 'G') echo 'selected';?>> G </option>
							                    <option value="H" <?php if($form->section == 'H') echo 'selected';?>> H </option>
							                    <option value="I" <?php if($form->section == 'I') echo 'selected';?>> I </option>
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
													if(isset($batch_list) && sizeof($batch_list)>0){
													foreach($batch_list as $batch){ 
													$batch_id = $batch->batch_id;
													?> 
												<option value="<?php echo $batch_id;?>" <?php if($batch_id ==  $form->batch_id) echo 'selected'; ?> ><?php echo $batch->batch_name;?></option>
													<?php }
													} ?>
											</select>
											<!-- <span class="help-block">This field has error.</span> -->
										</div>
										<?php $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
										$super_admin = $this->session->userdata(SESSION_CONST_PRE.'super_admin');
										?>
										<div class="col-md-4">
											<select name="admission_term" class="form-control" <?php if($super_admin == 'N') echo 'disabled'?> id="admission_term" data-placeholder="Choose a fee term" tabindex="1" >
							                    <?php // value of fee term is made by concate first digit from the division of the student like DIS=2 or DNS=1 
												if($div_id == '2'){	
												?>
							                    <option value="21" <?php if($form->admission_term == '21') echo 'selected="selected"';?>> 1st Term </option>
							                    <option value="22" <?php if($form->admission_term == '22') echo 'selected="selected"';?>> 2nd Term </option>
							                    <option value="23" <?php if($form->admission_term == '23') echo 'selected="selected"';?>> 3rd Term </option>
							                    <option value="24" <?php if($form->admission_term == '24') echo 'selected="selected"';?>> 4th Term </option>
							                    <?php } else {?>
							                    <option value="11" <?php if($form->admission_term == '11') echo 'selected="selected"';?>> 1st Term </option>
							                    <option value="12" <?php if($form->admission_term == '12') echo 'selected="selected"';?>> 2nd Term </option>
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
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('First Name');?>:</label>
										<div class="col-md-5">
											<?php 
												$first_name = $form->first_name;
												$last_name = $form->last_name;
												if($form->first_name == '' && $form->last_name ==''){
													$student_name = explode(' ', $form->student_name);
													//echo sizeof($student_name);
													for ($i=0; $i< sizeof($student_name) - 1; $i++){
														$first_name .= $name[$i].' ';
													}
													$last_name = $name[$i];
												}
											?>
											<input type="text" class="form-control" id="first_name" name="first_name" value='<?php echo $first_name;?>' placeholder="<?php echo Base_Controller::ToggleLang('First Name');?>" onblur="document.getElementById('student_name').value = this.value + ' ' + document.getElementById('last_name').value " />
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
										<div class="col-md-4">
											<input type="text" class="form-control" id="last_name" name="last_name" value='<?php echo $last_name;?>' placeholder="<?php echo Base_Controller::ToggleLang('Last Name');?>" onblur="document.getElementById('student_name').value = document.getElementById('first_name').value + ' ' + this.value" />
										</div>	
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Name');?> (Arabic):</label>
										<div class="col-md-8">
											<input type="text" class="form-control input-arabic" id="student_name_ar" name="student_name_ar" value='<?php echo $form->student_name_ar;?>' placeholder="<?php echo Base_Controller::ToggleLang('Arabic Name', 'ar');?>" />
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
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('ID Number');?>:<span class="required">*</span></label>
							<div class="col-md-9">
								<input type="text" class="form-control" data-required="1"  name="iqama_id" id="iqama_id" maxlength="10" value="<?php echo $form->iqama_id;?>" placeholder="<?php echo Base_Controller::ToggleLang('ID Number');?>"/>
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
												<option value="M" <?php if($form->gender ==  'M') echo 'selected="selected"'; ?> ><?php echo Base_Controller::ToggleLang('Male');?></option>
												<option value="F" <?php if($form->gender ==  'F') echo 'selected="selected"'; ?>><?php echo Base_Controller::ToggleLang('Female');?></option>
											</select>
											<!-- <span class="help-block">Select your gender.</span> -->
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
											<input type="text" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" name="issue_date" id="issue_expiry" maxlength="10" value="<?php if(isset($form->issue_date)) echo Util::displayFormat($form->issue_date); ?>" />
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Expiry Date');?>:<span class="required">*</span></label>
										<div class="col-md-8">
											<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" name="iqama_expiry" id="iqama_expiry" maxlength="10" value="<?php if(isset($form->iqama_expiry)) echo Util::displayFormat($form->iqama_expiry); ?>" />
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
											<input type="text" class="form-control form-control-inline " value="<?php if(isset($form->passport_id)) echo $form->passport_id; ?>" size="10" name="passport_id" id="passport_id" maxlength="10"  />
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Expiry Date');?>:</label>
										<div class="col-md-8">
											<input type="text" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" name="passport_expiry" id="passport_expiry" maxlength="10" value='<?php  echo Util::displayFormat($form->passport_expiry); ?>' />
										</div>
									</div>
								</div>
							</div>
							<!--/row-->
							<div class="row">
								<div class="col-md-6" >
									<div class="form-group">
										<?php $sibling_title = "Father / Mother name of sibling should be same. His own admission # can't use as sibling. Sibling admission # can be used one time only";?>
										<label class="control-label col-md-3 popovers" data-trigger="hover" data-container="body" data-placement="top" data-content="<?php echo $sibling_title;?>" data-original-title="Sibling Check"><?php echo Base_Controller::ToggleLang('Sibling');?>:</label>
										<div class="col-md-3">
											<div class="make-switch" data-on-label="Yes" data-off-label="No">
												<!-- if yes discount 10% for this sibling and sibling_student_id must be filled if it is yes-->
												<input type="checkbox" name="sibling" id="sibling" onchange="onchange_sibling(this)" <?php if(isset($form->sibling) && $form->sibling == 'Yes') echo 'checked';?> class="toggle"/>
											</div>
										</div>
										<div class="col-md-6" id="td_sibling">
											<input class="form-control" <?php if(isset($form->sibling) && $form->sibling == 'No') echo 'disabled="disabled"';?> name="sibling_student_id" id="sibling_student_id" value="<?php echo $form->sibling_student_id; ?>" onblur="validate_sibling_refer(this.value);"/>
											<input type="hidden" id="sibling_check" name="sibling_check" value="N" />
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6" >
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Employee Son');?>:</label>
										<div class="col-md-3">
											<div class="make-switch" data-on-label="Yes" data-off-label="No">
												<input type="checkbox" name="employee_kid" id="employee_kid" onchange="onchange_employee_kid(this)" <?php if(isset($form->employee_kid) && $form->employee_kid == 'Yes') echo 'checked';?> class="toggle"/>
												<input type="hidden" id="employee_kid_check" name="employee_kid_check" value="<?php if(isset($form->employee_kid) && !empty($form->employee_kid)) echo $form->employee_kid;?>" />
											</div>
										</div>
										<div class="col-md-5">
											<input class="form-control" <?php if(isset($form->employee_kid) && $form->employee_kid == 'No') echo 'disabled="disabled"';?> name="discount_on_employee_kid" id="discount_on_employee_kid" maxlength="2" style="text-align: right;" value="<?php echo $form->discount_on_employee_kid;?>" placeholder="Percent"/>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<!-- For DIS transport and edu plus not available -->
							<?php $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');?>
							<div class="row" style="<?php if($div_id == '2') echo 'display:none';?>">
								<div class="col-md-6" >
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Transportation');?>:</label>
										<div class="col-md-3">
											<div class="make-switch" data-on-label="Yes" data-off-label="No">
												<!-- avail transportation -->
												<input type="checkbox" name="transportation" id="transportation" onchange="onchange_transport(this)" <?php if(isset($form->transportation) && $form->transportation == 'Yes') echo 'checked';?> class="toggle"/>
											</div>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="transport_type" id="transport_type" <?php if(isset($form->transportation) && $form->transportation == 'No') echo 'disabled="disabled"';?> >
												<option value="TRANSPORT_FEE" <?php if($form->transport_type == 'TRANSPORT_FEE') echo 'selected'; ?> > One Way </option>
												<option value="TRANSPORT_FEE_2WAY" <?php if($form->transport_type == 'TRANSPORT_FEE_2WAY') echo 'selected'; ?> > Two Way </option>
											</select>
										</div>
										<div class="col-md-3">
											<select name="transport_term" id="transport_term" class="form-control" style="padding: 6px 6px;" <?php if((isset($form->transportation) && $form->transportation == 'No') || $super_admin == 'N') echo 'disabled="disabled"';?>  data-placeholder="Choose a fee term" tabindex="1" >
							                    <option value="0" <?php if($form->transport_term == '0') echo 'selected="selected"';?>>Full </option>
							                    <option value="1" <?php if($form->transport_term == '1') echo 'selected="selected"';?>>1st Term </option>
							                    <option value="2" <?php if($form->transport_term == '2') echo 'selected="selected"';?>>2nd Term </option>
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
												<input type="checkbox" name="education_plus" id="education_plus" onchange="onchange_education_plus(this)" <?php if(isset($form->education_plus) && $form->education_plus == 'Yes') echo 'checked';?> class="toggle"/>
											</div>
										</div>
										<div class="col-md-5">
											<input class="form-control" <?php if(isset($form->education_plus) && $form->education_plus == 'No') echo 'disabled="disabled"';?>  name="education_plus_fee" id="education_plus_fee" maxlength="4" style="text-align: right;" value="<?php if(isset($education_plus_fee)) echo $education_plus_fee; ?>" placeholder="0.00"/>
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<!--/row-->
							<?php if($admin_role == '1') {?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Enable');?>:</label>
										<div class="col-md-3">
											<div class="make-switch" data-on-label="Y" data-off-label="N">
												<!-- avail transportation -->
												<input type="checkbox" name="enable_cash_payment" id="enable_cash_payment" <?php if(isset($form->enable_cash_payment) && $form->enable_cash_payment == 'Y') echo 'checked';?> class="toggle"/>
											</div>
										</div>
										<label class="control-label col-md-5"><?php echo Base_Controller::ToggleLang('Cash Payment for one time');?></label>
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
							<!--/row-->
							<?php }?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Blood Group');?>:</label>
										<div class="col-md-9">
											<select name="blood_group" id="blood_group" class="form-control" tabindex="1">
												<option value="">Unknown</option>
												<option value="A+" <?php if($form->blood_group ==  'A+') echo 'selected="selected"'; ?>>A+</option>
												<option value="A-" <?php if($form->blood_group ==  'A-') echo 'selected="selected"'; ?> > A-</option>
												<option value="B+" <?php if($form->blood_group ==  'B+') echo 'selected="selected"'; ?>>B+</option>
												<option value="B-" <?php if($form->blood_group ==  'B-') echo 'selected="selected"'; ?>>B-</option>
												<option value="O+" <?php if($form->blood_group ==  'O+') echo 'selected="selected"'; ?>>O+</option>
												<option value="O-" <?php if($form->blood_group ==  'O-') echo 'selected="selected"'; ?>>O-</option>
												<option value="AB+" <?php if($form->blood_group ==  'AB+') echo 'selected="selected"'; ?>>AB+</option>
												<option value="AB-" <?php if($form->blood_group ==  'AB-') echo 'selected="selected"'; ?>>AB-</option>
											</select>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Date of Birth');?>:</label>
										<div class="col-md-8">
											<input type="text" name="date_of_birth" id="date_of_birth" value="<?php echo Util::dateDisplayFormate($form->date_of_birth);?>" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="16" placeholder="dd-mm-yyyy" />
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
											<input type="text" class="form-control" name="religion" id="religion"  value='<?php echo $form->religion;?>' placeholder="Religion"/>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Nationality');?>:</label>
										<div class="col-md-8">
											<select name="nationality" class="form-control" id="nationality" >
												<option> </option>
												<?php foreach($country_list as $country){ 
													$country_id = $country->id;
													?> 
													<option value="<?php echo $country_id;?>" <?php if($country_id ==  $form->nationality) echo 'selected'; ?> ><?php if($lang == 'ar') echo $country->country_ar; else echo $country->country_name;?></option>
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
											<input type="text" class="form-control" name="language" id="language" value='<?php echo $form->language;?>' placeholder="<?php echo Base_Controller::ToggleLang('Language');?>" />
											<!-- <span class="help-block">This is inline help</span> -->
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Birth Place');?>:</label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="birth_place" id="birth_place" maxlength="14" value='<?php echo $form->birth_place;?>' placeholder="<?php echo Base_Controller::ToggleLang('Birth Place');?>" />
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
											<input type="text" class="form-control" data-required="1" name="father_name" id="father_name" value="<?php if(isset($form->father_name)) echo $form->father_name; ?>" >
											<span class="help-block">As shown in Passport.</span><span class="has-error"><?php echo form_error('father_name');?></span>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Mother Name');?></label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="mother_name" id="mother_name" value='<?php if(isset($form->mother_name)) echo $form->mother_name; ?>' >
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
											<input type="text" class="form-control" name="work_place_father" id="work_place_father" value='<?php if(isset($form->work_place_father)) echo $form->work_place_father; ?>'> 
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Work Place');?></label>
										<div class="col-md-8">
											<input type="text"  class="form-control" name="work_place_mother" id="work_place_mother" value='<?php if(isset($form->work_place_mother)) echo $form->work_place_mother; ?>'> 
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
											<input type="text" class="form-control" maxlength="10" name="id_number_father" id="id_number_father" value='<?php if(isset($form->id_number_father)) echo $form->id_number_father; ?>'> 
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('ID Number');?></label>
										<div class="col-md-8">
											<input type="text" class="form-control" maxlength="10" name="id_number_mother" id="id_number_mother" value='<?php if(isset($form->id_number_mother)) echo $form->id_number_mother; ?>'>
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
											<input type="text" class="form-control" maxlength="20" name="work_phone_father" id="work_phone_father" value='<?php if(isset($form->work_phone_father)) echo $form->work_phone_father; ?>' /> 
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Work Phone');?></label>
										<div class="col-md-8">
											<input type="text" class="form-control" maxlength="20" name="work_phone_mother" id="work_phone_mother" value='<?php if(isset($form->work_phone_mother)) echo $form->work_phone_mother; ?>' />
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
											<input type="text" data-required="1" maxlength="20" class="form-control" name="cell_phone_father" id="cell_phone_father" value="<?php if(isset($form->cell_phone_father)) echo $form->cell_phone_father; ?>" />
											<span class="has-error"><?php echo form_error('cell_phone_father');?></span> 
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Cell Phone');?></label>
										<div class="col-md-8">
											<input type="text" class="form-control" maxlength="20" name="cell_phone_mother" id="cell_phone_mother" value="<?php if(isset($form->cell_phone_mother)) echo $form->cell_phone_mother; ?>" />
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
											<input type="text" class="form-control" name="email_father" id="email_father" value='<?php if(isset($form->email_father)) echo $form->email_father; ?>' /> 
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo Base_Controller::ToggleLang('Email');?></label>
										<div class="col-md-8">
											<input type="text" class="form-control" name="email_mother" id="email_mother" value='<?php if(isset($form->email_mother)) echo $form->email_mother; ?>' />
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
											<input type="text" class="form-control" name="address_line1" id="address_line1" value='<?php echo $form->address_line1;?>'>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Address Line2');?></label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="address_line2" id="address_line2" value='<?php echo $form->address_line2;?>' >
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('City / Town');?></label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="city" id="city" value='<?php echo $form->city;?>'> 
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('State / Province');?></label>
										<div class="col-md-9">
											<input type="text"  class="form-control" name="state" id="state" value='<?php echo $form->state;?>'> 
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
											<input type="text" class="form-control" name="email" id="email" value='<?php echo $form->email;?>' />
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Country');?></label>
										<div class="col-md-9">
											<select class="form-control" name="country_id" id="country_id">
												<?php foreach($country_list as $country){ 
													$country_id = $country->id;
													?> 
													<option value="<?php echo $country_id;?>" <?php if($country_id ==  $form->country_id) echo 'selected'; ?> ><?php if($lang == 'ar') echo $country->country_ar; else echo $country->country_name;?></option>
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
										<button type="button" class="btn green" onclick="updateForm()" ><i class="fa fa-check"></i> <?php echo Base_Controller::ToggleLang('Submit');?></button>
										<button type="button" class="btn default" onclick="window.open('<?php echo base_url().$model;?>', '_self')" ><?php echo Base_Controller::ToggleLang('Cancel');?></button>                              
									</div>
								</div>
								<div class="col-md-6"></div>
							</div>
						</div>
						<input type="hidden" name="admission_term_old" id="admission_term_old" value="<?php if(isset($form->admission_term)) echo $form->admission_term;?>" />
					<?php echo form_close();?>
					<!-- END FORM-->                
				</div>
			</div>
		</div>
			
		<div class="tab-pane " id="tabs_1"><?php
			if(sizeof($guardian)>0){
				$parent = $guardian[0];
				include "edit_parent_detail.php";
			}
			else { include "add_parent_detail.php"; }?>
		</div>
		<!-- <div class="tab-pane " id="tabs_2" style="height: 420px"><?php include "edit_emergency_detail.php"?></div> -->
		<div class="tab-pane " id="tabs_3" style="height: 420px"><?php if(isset($previous_data[0])) { include "edit_previous_detail.php";}else {include "add_previous_detail.php";}?></div>
	</div>
</div>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript" ></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js" type="text/javascript" ></script>

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
		});

		function updateForm(){
			document.getElementById('sibling_student_id').disabled = false;
			submitForm();	 
		}
		
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
	        document.getElementById('sibling_check').value = 'Y';
        }

        function validate_sibling_refer(val){
        	if(val.length >= 11){
        		var params = 'student_id='+document.getElementById('student_id').value;
        		params += '&mother_name='+document.getElementById('mother_name').value;
        		params += '&father_name='+document.getElementById('father_name').value;
        		get('<?php echo base_url().'students/valid_sibling/';?>'+val, ''+params, 'td_sibling','false','');  
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
        	document.getElementById('transport_term').disabled = true;
	    	document.getElementById('transport_type').disabled = true;
		    if(obj.checked){		    	
		        document.getElementById('transport_term').disabled = false;
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
		    	//document.getElementById('education_plus_fee').value = '0.00';
		    	document.getElementById('education_plus_fee').disabled = true;
		    }
	  	}
</script>