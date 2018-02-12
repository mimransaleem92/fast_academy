<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>
<?php  
    $form = $form[0];
    $name = explode(' ', $form->student_name);
	$today    = date('Y-m-d'); ?>
<div class="tabbable tabbable-custom boxless">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs_0" data-toggle="tab">Student Details</a></li>
		<li><a href="#tabs_1" data-toggle="tab">Documents & Files<!-- Parent Details --></a></li>
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
					<?php echo form_open('enrollment/update',array('id'=>'mainForm', 'enctype'=>"multipart/form-data", 'class'=>"form-horizontal")); $today = date('Y-m-d'); ?>
						<div class="form-body">
							<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Personal Details');?></h3>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Admission No');?>:</label>
										<div class="col-md-6">
											<input type="hidden" id="student_id" name="student_id" value='<?php echo $form->student_id;?>' >
											<input type="text" class="form-control" readonly="readonly" id="admission_number" name="admission_number" value='<?php echo $form->admission_number;?>' placeholder="<?php echo Base_Controller::ToggleLang('Admission No');?>">
										</div>
										<label class="control-label arabic col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Admission No', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Student full name');?>:</label>
										<div class="col-md-3">
											<input type="text" class="form-control" id="student_name" name="student_name" value='<?php echo $form->student_name;?>' placeholder="<?php echo Base_Controller::ToggleLang('Student Name');?>">
											<span class="help-block">As shown in Passport</span>
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control" style='font-family: "DroidKufi Regular", Tahoma; text-align: right;' id="student_name_ar" name="student_name_ar" value='<?php echo $form->student_name_ar;?>' placeholder="<?php echo Base_Controller::ToggleLang('Student Name', 'ar');?>">
										</div>
										<label class="control-label arabic col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Student full name', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Date of birth').' / '.Base_Controller::ToggleLang('Age').' / '.Base_Controller::ToggleLang('Gender');?>:</label>
										<div class="col-md-2">
											<input type="text" class="form-control form-control-inline" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="date_of_birth" name="date_of_birth" value='<?php echo Util::dateDisplayFormate($form->date_of_birth);?>' onChange="calculateAge()" placeholder="<?php echo Base_Controller::ToggleLang('Date of birth');?>" >
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" readonly="readonly" id="age" name="age" value='<?php  if(!is_null($form->date_of_birth) && $form->date_of_birth != '0000-00-00') echo Util::ageCalculator($form->date_of_birth);?>' placeholder="<?php echo Base_Controller::ToggleLang('Age');?>">
										</div>
										<div class="col-md-2">
											<select class="form-control" name="gender" id='gender'>
												<option value="M" <?php if($form->gender ==  'M') echo 'selected="selected"'; ?>><?php echo Base_Controller::ToggleLang('Male');?></option>
												<option value="F" <?php if($form->gender ==  'F') echo 'selected="selected"'; ?>><?php echo Base_Controller::ToggleLang('Female');?></option>
											</select>
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;' ><?php echo Base_Controller::ToggleLang('Date of birth', 'ar').' / '.Base_Controller::ToggleLang('Age', 'ar').' / '.Base_Controller::ToggleLang('Gender', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Nationality');?>:</label>
										<div class="col-md-4">
											<select name="nationality" class="form-control" id="nationality" >
												<?php foreach($country_list as $country){ 
													$country_id = $country->id;
													?> 
													<option value="<?php echo $country_id;?>" <?php if($country_id ==  $form->nationality) echo 'selected'; ?> ><?php if($lang == 'ar') echo $country->country_ar; else echo $country->country_name;?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-2"></div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Nationality', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('ID Number').' / '.Base_Controller::ToggleLang('Expiry Date');?>:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="iqama_id" name="iqama_id" maxlength="10" value='<?php echo $form->iqama_id;?>' placeholder="<?php echo Base_Controller::ToggleLang('ID Number');?>">
											
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="iqama_expiry" name="iqama_expiry" value="<?php if(isset($form->iqama_expiry)) echo Util::displayFormat($form->iqama_expiry); ?>" placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('ID Number', 'ar').' / '.Base_Controller::ToggleLang('Expiry Date', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Passport Number').' / '.Base_Controller::ToggleLang('Expiry Date');?>:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" id="passport_id" name="passport_id" value='<?php if(isset($form->passport_id)) echo $form->passport_id; ?>' placeholder="<?php echo Base_Controller::ToggleLang('Passport Number');?>">
											
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="passport_expiry" name="passport_expiry" value='<?php if(isset($form->passport_expiry)) echo Util::displayFormat($form->passport_expiry); ?>' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Passport Number', 'ar').' / '.Base_Controller::ToggleLang('Expiry Date', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Enrollment Grade').' / '.Base_Controller::ToggleLang('Date');?>:</label>
										<div class="col-md-4">
											<?php 
											if(!empty($form->enrollment_grade_level)){ $enrollment_grade_level = $form->enrollment_grade_level; }
											else{
												$enrollment_grade_level = ($form->course_id < 4) ? 'KG '.$form->course_id : 'Grade '.($form->course_id-3);
											}
											?>
											<input type="text" class="form-control" readonly="readonly" name="enrollment_grade_level" id="enrollment_grade_level" value="<?php echo $enrollment_grade_level; ?>" />
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" readonly="readonly" id="admission_date" name="admission_date" value='<?php if($form->admission_date != '0000-00-00') echo Util::displayFormat($form->admission_date); else echo Util::displayFormat($today);?>' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Enrollment Grade', 'ar').' / '.Base_Controller::ToggleLang('Date', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Previous School');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="previous_school" id="previous_school" value="<?php if(isset($form->previous_school)) echo $form->previous_school; ?>" />
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Previous School', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Present Grade').' / '.Base_Controller::ToggleLang('Section');?>:</label>
										<div class="col-md-4">
											<select name="course_id" class="form-control" id="course_id" data-placeholder="Choose a Course" tabindex="1" onchange="onchange_courses(this)">
							                    <option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
							                    <?php foreach($courses_list as $course){ 
							                    	$course_id = $course->course_id; 
							                    	if($course_id > 15) continue;
							                    	?> 
							                    	<option value="<?php echo $course_id;?>" <?php if($course_id ==  $form->course_id) echo 'selected'; ?> ><?php echo $course->course_name;?></option>
							                    <?php } ?>
											</select>
										</div>
										<div class="col-md-2">
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
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Present Grade', 'ar').' / '.Base_Controller::ToggleLang('Section', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Academic Year').' / '.Base_Controller::ToggleLang('Term');?>:</label>
										<div class="col-md-2" id="td_batch">
											<select id="batch_id" name="batch_id" class="form-control" data-placeholder="Choose a Session" tabindex="1">
												<option value="">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
												<?php 
													if(isset($batch_list) && sizeof($batch_list)>0){ $i = 0; $count = sizeof($batch_list); 
													foreach($batch_list as $batch){ $i++;
													$batch_id = $batch->batch_id;
													?> 
														<option value="<?php echo $batch_id;?>" <?php if($batch_id ==  $form->batch_id) echo 'selected'; ?> ><?php echo $batch->batch_name;?></option>
													<?php }
													} ?>
											</select>
										</div>
										<?php $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');
										 $super_admin = $this->session->userdata(SESSION_CONST_PRE.'super_admin');
										?>
										<div class="col-md-2">
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
										<div class="col-md-2"></div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Academic Year', 'ar').' / '.Base_Controller::ToggleLang('Term', 'ar');?></label>
									</div>
								</div>
							</div>
							<!-- For DIS transport and edu plus not available -->
							<?php $div_id = $this->session->userdata(SESSION_CONST_PRE.'division_id');?>
							<div class="row" style="<?php if($div_id == '2') echo 'display:none';?>">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Transportation');?>:</label>
										<div class="form-group col-md-5">
											<div class="col-md-3">
												<div class="make-switch" data-on-label="Yes" data-off-label="No">
													<input type="checkbox" name="transportation" id="transportation" onchange="onchange_transport(this)" <?php if(isset($form->transportation) && $form->transportation == 'Yes') echo 'checked';?> class="toggle"/>
												</div>
											</div>
											<div class="col-md-5">
												<select class="form-control input-sm" name="transport_type" id="transport_type" <?php if(isset($form->transportation) && $form->transportation == 'No') echo 'disabled="disabled"';?> >
													<option value="TRANSPORT_FEE" <?php if($form->transport_type == 'TRANSPORT_FEE') echo 'selected'; ?> > One Way </option>
													<option value="TRANSPORT_FEE_2WAY" <?php if($form->transport_type == 'TRANSPORT_FEE_2WAY') echo 'selected'; ?> > Two Way </option>
												</select>
											</div>
											<div class="col-md-4">
												<select name="transport_term" id="transport_term" class="form-control input-sm" style="padding: 6px 6px;" <?php if((isset($form->transportation) && $form->transportation == 'No') || $super_admin == 'N') echo 'disabled="disabled"';?>  data-placeholder="Choose a fee term" tabindex="1" >
								                    <option value="0" <?php if($form->transport_term == '0') echo 'selected="selected"';?>>Full </option>
								                    <option value="1" <?php if($form->transport_term == '1') echo 'selected="selected"';?>>1st Term </option>
								                    <option value="2" <?php if($form->transport_term == '2') echo 'selected="selected"';?>>2nd Term </option>
												</select>
											</div>
										</div>
										<div class="col-md-1"></div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left; padding-left: 48px'><?php echo Base_Controller::ToggleLang('Transportation', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Education Plus');?>:</label>
										<div class="form-group col-md-5">
											<div class="col-md-3">
												<div class="make-switch" data-on-label="Yes" data-off-label="No">
													<input type="checkbox" name="education_plus" id="education_plus" onchange="onchange_education_plus(this)" <?php if(isset($form->education_plus) && $form->education_plus == 'Yes') echo 'checked';?> class="toggle"/>
												</div>
											</div>	
											<div class="col-md-9">
												<input class="form-control input-sm" <?php if(isset($form->education_plus) && $form->education_plus == 'No') echo 'disabled="disabled"';?>  name="education_plus_fee" id="education_plus_fee" maxlength="7" style="text-align: right;" value="<?php if(isset($education_plus_fee)) echo $education_plus_fee; ?>" placeholder="0.00"/>
											</div>
										</div>
										<div class="col-md-1"></div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left; padding-left: 48px'><?php echo Base_Controller::ToggleLang('Education Plus', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<?php $sibling_title = "Father / Mother name of sibling should be same. His own admission # can't use as sibling. Sibling admission # can be used one time only";?>
										<label class="control-label col-md-3 popovers" data-trigger="hover" data-container="body" data-placement="top" data-content="<?php echo $sibling_title;?>" data-original-title="Sibling Check"><?php echo Base_Controller::ToggleLang('Sibling');?>:</label>
										<div class="form-group col-md-5">
											<div class="col-md-3">
												<div class="make-switch" data-on-label="Yes" data-off-label="No">
													<!-- if yes discount 10% for this sibling and sibling_student_id must be filled if it is yes-->
													<input type="checkbox" name="sibling" id="sibling" onchange="onchange_sibling(this)" <?php if(isset($form->sibling) && $form->sibling == 'Yes') echo 'checked';?> class="toggle"/>
												</div>
											</div>
											<div class="col-md-9" id="td_sibling">
												<input class="form-control input-sm" <?php if(isset($form->sibling) && $form->sibling == 'No') echo 'disabled="disabled"';?> name="sibling_student_id" id="sibling_student_id" value="<?php echo $form->sibling_student_id; ?>" onblur="validate_sibling_refer(this.value);"/>
												<input type="hidden" id="sibling_check" name="sibling_check" value="N" />
											</div>
										</div>	
										<div class="col-md-1"></div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left; padding-left: 48px'><?php echo Base_Controller::ToggleLang('Sibling', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Employee Son');?>:</label>
										<div class="form-group col-md-5">
											<div class="col-md-3">
												<div class="make-switch" data-on-label="Yes" data-off-label="No">
													<input type="checkbox" name="employee_kid" id="employee_kid" onchange="onchange_employee_kid(this)" <?php if(isset($form->employee_kid) && $form->employee_kid == 'Yes') echo 'checked';?> class="toggle"/>
													<input type="hidden" id="employee_kid_check" name="employee_kid_check" value="<?php if(isset($form->employee_kid) && !empty($form->employee_kid)) echo $form->employee_kid;?>" />
												</div>
											</div>
											<div class="col-md-9">
												<input class="form-control" <?php if(isset($form->employee_kid) && $form->employee_kid == 'No') echo 'disabled="disabled"';?> name="discount_on_employee_kid" id="discount_on_employee_kid" maxlength="2" style="text-align: right;" value="<?php echo $form->discount_on_employee_kid;?>" placeholder="Percent"/>
											</div>
										</div>
										<div class="col-md-1"></div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left; padding-left: 48px'><?php echo Base_Controller::ToggleLang('Employee Son', 'ar');?></label>
									</div>
								</div>
							</div>
							<?php if($admin_role == '1') {?>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Enable Cash Payment');?>:</label>
										<div class="form-group col-md-5">
											<div class="col-md-3">
												<div class="make-switch" data-on-label="Y" data-off-label="N">
													<input type="checkbox" name="enable_cash_payment" id="enable_cash_payment" <?php if(isset($form->enable_cash_payment) && $form->enable_cash_payment == 'Y') echo 'checked';?> class="toggle"/>
												</div>
											</div>
											<label class="control-label col-md-9"><?php echo Base_Controller::ToggleLang('Cash Payment for one time');?></label>
											
										</div>
										<div class="col-md-1"></div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left; padding-left: 48px'><?php echo Base_Controller::ToggleLang('Employee Son', 'ar');?></label>
									</div>
								</div>
							</div>
							<?php }?>
							<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Parental Details');?></h3>
							<!-- Father Info -->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Father full name');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="father_name" name="father_name" value="<?php if(isset($form->father_name)) echo $form->father_name; ?>" placeholder="<?php echo Base_Controller::ToggleLang('Father full name');?>">
											<span class="help-block">As shown in Passport</span>
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Father full name', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Occupation');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="occupation_father" name="occupation_father" value="<?php if(isset($form->occupation_father)) echo $form->occupation_father; ?>" placeholder="<?php echo Base_Controller::ToggleLang('Occupation');?>">
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Occupation', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Name of the Company');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="work_place_father" id="work_place_father" value="<?php if(isset($form->work_place_father)) echo $form->work_place_father; ?>">
											 
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Name of the Company','ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('ID Number').' / '.Base_Controller::ToggleLang('Expiry Date');?>:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="id_number_father" id="id_number_father" maxlength="10" value='<?php if(isset($form->id_number_father)) echo $form->id_number_father; ?>'>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="iqama_expiry_father" name="iqama_expiry_father" value='<?php if(isset($form->iqama_expiry_father)) echo Util::displayFormat($form->iqama_expiry_father); ?>' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('ID Number','ar').' / '.Base_Controller::ToggleLang('Expiry Date','ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Passport Number').' / '.Base_Controller::ToggleLang('Expiry Date');?>:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="passport_father" id="passport_father" value='<?php if(isset($form->passport_father)) echo $form->passport_father; ?>'>
											 
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="passport_expiry_father" name="passport_expiry_father" value='<?php if(isset($form->passport_expiry_father)) echo Util::displayFormat($form->passport_expiry_father); ?>' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Passport Number','ar').' / '.Base_Controller::ToggleLang('Expiry Date','ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Work Phone').' / '.Base_Controller::ToggleLang('Cell Phone');?>:</label>
										<div class="col-md-3">
											<input type="text" class="form-control" name="work_phone_father" id="work_phone_father" value='<?php if(isset($form->work_phone_father)) echo $form->work_phone_father; ?>'>
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control" name="cell_phone_father" id="cell_phone_father" value='<?php if(isset($form->cell_phone_father)) echo $form->cell_phone_father; ?>'>
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Work Phone','ar').' / '.Base_Controller::ToggleLang('Cell Phone','ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Email');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="email_father" id="email_father" value='<?php if(isset($form->email_father)) echo $form->email_father; ?>'>
											 
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Email','ar');?></label>
									</div>
								</div>
							</div>	
						<!--</div>
					</div>
					
					<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Parent Details');?></h3>
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-home"></i><?php echo "Parents Info";?>
							</div>
						</div>
						<div class="portlet-body" style="height:100%">-->
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Mother full name');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="mother_name" name="mother_name" value='<?php if(isset($form->mother_name)) echo $form->mother_name; ?>' placeholder="<?php echo Base_Controller::ToggleLang('Mother full name');?>">
											<span class="help-block">As shown in Passport</span>
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Mother full name', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Occupation');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="occupation_mother" name="occupation_mother" value='<?php if(isset($form->occupation_mother)) echo $form->occupation_mother; ?>' placeholder="<?php echo Base_Controller::ToggleLang('Occupation');?>">
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Occupation', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Name of the Company');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="work_place_mother" id="work_place_mother" value='<?php if(isset($form->work_place_mother)) echo $form->work_place_mother; ?>'>
											 
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Name of the Company','ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('ID Number').' / '.Base_Controller::ToggleLang('Expiry Date');?>:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="id_number_mother" id="id_number_mother" maxlength="10" value='<?php if(isset($form->id_number_mother)) echo $form->id_number_mother; ?>'>
											 
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="iqama_expiry_mother" name="iqama_expiry_mother" value='<?php if(isset($form->iqama_expiry_mother)) echo Util::displayFormat($form->iqama_expiry_mother); ?>' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('ID Number','ar').' / '.Base_Controller::ToggleLang('Expiry Date', 'ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Passport Number').' / '.Base_Controller::ToggleLang('Expiry Date');?>:</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="passport_mother" id="passport_mother" value='<?php if(isset($form->passport_mother)) echo $form->passport_mother; ?>'>
											 
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="passport_expiry_mother" name="passport_expiry_mother" value='<?php if(isset($form->passport_expiry_mother)) echo Util::displayFormat($form->passport_expiry_mother); ?>' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Passport Number','ar').' / '.Base_Controller::ToggleLang('Expiry Date','ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Work Phone').' / '.Base_Controller::ToggleLang('Cell Phone');?>:</label>
										<div class="col-md-3">
											<input type="text" class="form-control" name="work_phone_mother" id="work_phone_mother" value='<?php if(isset($form->work_phone_mother)) echo $form->work_phone_mother; ?>'>
											 
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control" name="cell_phone_mother" id="cell_phone_mother" value='<?php if(isset($form->cell_phone_mother)) echo $form->cell_phone_mother; ?>'>
											 
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Work Phone','ar').' / '.Base_Controller::ToggleLang('Cell Phone','ar');?></label>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Email');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="email_mother" id="email_mother" value='<?php if(isset($form->email_mother)) echo $form->email_mother; ?>'>
											 
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Email','ar');?></label>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Local Address');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="address_line1" id="address_line1" value='<?php if(isset($form->address_line1)) echo $form->address_line1; ?>'>
											 
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Local Address','ar');?></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Emergency Contact');?>:</label>
										<div class="col-md-2">
											<input type="text" class="form-control" name="emergency_contact_name" id="emergency_contact_name" placeholder="Name" value='<?php if(isset($form->emergency_contact_name)) echo $form->emergency_contact_name; ?>'>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" name="emergency_contact_relation" id="emergency_contact_relation" placeholder="Relation" value='<?php if(isset($form->emergency_contact_relation)) echo $form->emergency_contact_relation; ?>'>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" name="emergency_contact" id="emergency_contact" placeholder="Contact #" value='<?php if(isset($form->emergency_contact)) echo $form->emergency_contact; ?>'>
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Emergency Contact','ar');?></label>
									</div>
								</div>
							</div>
							<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Required Documents');?></h3>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Check List');?>:</label>
										<div class="col-md-6" style="text-align: left">
											<label><input type="checkbox" id="checkall" onclick="setAllCheckOptions()">
											Select All</label><br> 
											<?php $check_list = array();
												if(!empty($form->check_list)){
													$arr = explode(',', $form->check_list);
													foreach ($arr as $val){
														$check_list[$val] = $val;
													}
												}
											?>
											<label><input type="checkbox" name="option1" id="option1" <?php if(isset($check_list[1])) echo 'checked="checked"';?> >
											Copy of student's passport</label><br>
											<label><input type="checkbox" name="option2" id="option2" <?php if(isset($check_list[2])) echo 'checked="checked"';?>>
											Copy of father's passport</label><br>
											<label><input type="checkbox" name="option3" id="option3" <?php if(isset($check_list[3])) echo 'checked="checked"';?>>
											Copy of student's identification card (Bitaqa, Iqama)</label><br>
											<label><input type="checkbox" name="option4" id="option4" <?php if(isset($check_list[4])) echo 'checked="checked"';?>>
											Copy of father's identification card (Bitaqa, Iqama)</label><br>
											<label><input type="checkbox" name="option5" id="option5" <?php if(isset($check_list[5])) echo 'checked="checked"';?>>
											Introduction Letter from Sponsor (Company)</label><br>
											<label><input type="checkbox" name="option6" id="option6" <?php if(isset($check_list[6])) echo 'checked="checked"';?>>
											Copy of student's birth certificate</label><br>
											<label><input type="checkbox" name="option7" id="option7" <?php if(isset($check_list[7])) echo 'checked="checked"';?>>
											Copy of student's vaccination certificate</label><br>
											<label><input type="checkbox" name="option8" id="option8" <?php if(isset($check_list[8])) echo 'checked="checked"';?>>
											Financial Clearance Letter from the previous school</label><br>
											<label><input type="checkbox" name="option9" id="option9" <?php if(isset($check_list[9])) echo 'checked="checked"';?>>
											Original Previous Report Cards  </label><br>
											<label><input type="checkbox" name="option10" id="option10" <?php if(isset($check_list[10])) echo 'checked="checked"';?>>
											Admission Form (all information must be filled and signed by parents)</label><br>
											<label><input type="checkbox" name="option11" id="option11" <?php if(isset($check_list[11])) echo 'checked="checked"';?>>
											Printout from Noor System</label><br>
											<label><input type="checkbox" name="option12" id="option12" <?php if(isset($check_list[12])) echo 'checked="checked"';?>>
											Two recent photos (passport size)</label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Attach files');?>:</label>
										<div class="col-md-6" style="text-align: left">
											<input type="file" name="files[]" id="files0" multiple="multiple" size="20" onchange="getFileSizeandName(this);" >
											<span class="col-md-6" id="filecount"></span> <span class="col-md-6" id="totalsize"></span>
											
											<label class="control-label" style="text-align: left"><?php echo Base_Controller::ToggleLang('Max. size for upload files at once is') . " " . ini_get("upload_max_filesize").'B';?></label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Remarks');?>:</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="remarks" id="remarks" value='<?php if(isset($form->remarks)) echo $form->remarks; ?>'>
											 
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Remarks','ar');?></label>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Skip Validation');?>:</label>
										<div class="form-group col-md-6">
											<div class="col-md-3">
												<div class="make-switch" data-on-label="Y" data-off-label="N">
													<input type="checkbox" name="skip_validate" id="skip_validate" onchange="onchange_skip_validate(this)" <?php if(isset($form->skip_validate) && $form->skip_validate == 'Y') echo 'checked';?> class="toggle"/>
													
												</div>
											</div>
											<div class="col-md-9">
												<input class="form-control input-sm" <?php if(isset($form->skip_validate) && $form->skip_validate == 'N') echo 'disabled="disabled"';?> name="skip_validate_note" id="skip_validate_note" maxlength="255" value="<?php echo $form->skip_validate_note;?>" placeholder="Note"/>
											</div>
											<span class="required" style="padding-left: 15px" id="skip_validate_span"></span>
										</div>
										<div class="col-md-1"></div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left; padding-left: 48px'><?php echo Base_Controller::ToggleLang('Skip Validation', 'ar');?></label>
									</div>
								</div>
							</div>
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
		<div class="tab-pane " id="tabs_1">
			<?php
			include "edit_attached_files.php";
			/*if(sizeof($guardian)>0){
				$parent = $guardian[0];
				include "edit_parent_detail.php";
			}
			else { include "add_parent_detail.php"; } */ ?>
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
	           $('#date_of_birth').datepicker({
	        	    startDate: '-18y',
	        	    endDate: '-2y',
	        	    dateFormat: 'dd-mm-yy',
	        	    onclose: function(){
		        	    document.getElementById('age').focus();
	        	    },
	        	    autoclose: true
	        	});
	           $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
	       }
		});
		
		function updateForm(){
			var skip_validate = document.getElementById('skip_validate');
			if(skip_validate.checked)
			{
				if(document.getElementById('skip_validate_note').value == ''){
					document.getElementById('skip_validate_span').innerHTML = 'Please enter note. Why are you skipping validation?';
					return false;
				}
				document.getElementById('sibling_student_id').disabled = false;
				submitForm();
			}
			var std_grade = document.getElementById('course_id').value;
			var obj = document.getElementById('mainForm');
			var skip_validate = ['discount_on_employee_kid', 'sibling_student_id', 'education_plus_fee', 'skip_validate_note'];
			for (i=0; i<obj.elements.length; i++) 
			{
				if (obj.elements[i].type == "text" && obj.elements[i].value == '') 
				{
					var f = false;
					for(a=0;a<skip_validate.length;a++){
						if(obj.elements[i].id == skip_validate[a]) {
							f = true;
							break;
						}
					}
					if(f) continue;
					App.scrollTo($('#'+obj.elements[i].id), -100);
					obj.elements[i].focus();
					$('#'+obj.elements[i].id).closest('.form-group').addClass('has-error');
					return false;
					break;
				}
				else{
					$('#'+obj.elements[i].id).closest('.form-group').removeClass('has-error');
				}
			}
			if(std_grade == ''){
        		App.scrollTo($('#course_id'), -200);
                $('#course_id').closest('.form-group').addClass('has-error');
    	    	return false;
			}
			else {
				$('#course_id').closest('.form-group').removeClass('has-error');
				document.getElementById('sibling_student_id').disabled = false;
				submitForm();
			}
		}

		function calculateAge(){
			//console.log('Start Func');
			var dtElem1 = document.getElementById('date_of_birth');
		    var dtElem2 = document.getElementById('admission_date');
		    var resultElem = document.getElementById('age');
		    
		    // Return if no such element exists
		    if(!dtElem1 || !dtElem2 || !resultElem) {
		      return;
		    }
		   
		    //assuming that the delimiter for dt time picker is a '-'.
		    var x = dtElem1.value;
		    var y = dtElem2.value;
		    var arr1 = x.split('-');
		    var arr2 = y.split('-');
		    
		    // If any problem with input exists, return with an error msg
		    if(!arr1 || !arr2 || arr1.length != 3 || arr2.length != 3) {
		    //  resultElem.value = "Invalid Input";
		      return;
		    }

		    var dt1 = new Date();
		    dt1.setFullYear(arr1[2], arr1[1], arr1[0]);
		    var dt2 = new Date();
		    dt2.setFullYear(arr2[2], arr2[1], arr2[0]);
		    
		    var numLeave = (dt2.getTime() - dt1.getTime()) / (60 * 60 * 24 * 1000) + 1;
		    console.log(numLeave);
		    if(numLeave>0){
			    age_year = parseInt(numLeave / 365);
			    age_month = parseInt( (numLeave - (age_year*365))/30 );
			    age = '';
			    if(age_year > 0){
			    	age = age_year + ' Y';
			    }
			    
			    if(age_month > 0) {
			    	
				    if(age != ''){ 
				    	age = age + ' & ' + age_month + ' M';
				    }
				    else
				    {
				    	age = age_month + ' M';
				    }
			    }
		    	resultElem.value = age;
			}
	    }
		
		function setAllCheckOptions(){
			var obj = document.getElementById('checkall');
	        if(obj.checked){
	        	for(a=1;a<=12;a++){
					document.getElementById('option'+a).checked = true;
					$('input#option'+a).closest('span').addClass('checked');
				}
	        }
	        else{
	        	for(a=1;a<=12;a++){
					document.getElementById('option'+a).checked = false;
					$('input#option'+a).closest('span').removeClass('checked');
				}
	        }	
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

        function onchange_skip_validate(obj){
        	document.getElementById('skip_validate_note').disabled = true;
	        if(obj.checked){
	        	document.getElementById('skip_validate_note').value = '';
	        	document.getElementById('skip_validate_note').disabled = false;
	        	document.getElementById('skip_validate_note').focus();
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