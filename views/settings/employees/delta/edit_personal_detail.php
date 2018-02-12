	<div class="clearfix"></div>
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption" ><?php echo Base_Controller::ToggleLang('Personal Information');?></div>
			<div class="tools" ><span style="font-family: tahoma"><?php echo Base_Controller::ToggleLang('Personal Information', 'ar');?></span></div>
		</div>
		<div class="portlet-body" >
			<div class="form-group">
				<div class="col-md-3">
					<label  class="control-label" for="attendance_log_id"><?php echo Base_Controller::ToggleLang('Attendance Log ID NO');?></label>
					<div class="form-group">
						<input type="text" id="attendance_log_id" name="attendance_log_id" class="form-control" size="20" value="<?php echo $form->attendance_log_id;?>">
					</div>
				</div>
				
				<div class="col-md-3">
					<label  class="control-label" for="joining_date"><?php echo Base_Controller::ToggleLang('Joining Date');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="joining_date" id="joining_date" class="form-control form-control-inline date-picker" value="<?php echo util::displayFormat($form->joining_date);?>" data-date-format="dd-mm-yyyy" size="16" placeholder="D-M-Y"/>
						<span class="help-block"></span>
					</div>
				</div>
				<div class="col-md-3">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('School');?></label>
					<div class="form-group">
					<select  class="form-control" name="division_id" id="division_id" >
						<?php 
							$curr_div = $form->division_id;
							foreach($division_list as $div){ 
							$div_id = $div->division_id;
							?> 
							<option value="<?php echo $div_id;?>" <?php if($div_id ==  $curr_div) echo 'selected'; ?> ><?php echo $div->name;?></option>
						<?php } ?>
					</select></div>
				</div>
				<div class="col-md-3"></div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group" style="direction: rtl">
				<div class="col-md-3">
					<label  class="control-label lbl-arabic"><?php echo Base_Controller::ToggleLang('Family Name','ar');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="familyname_ar" id="familyname_ar" class="form-control" value="<?php echo $form->familyname_ar;?>" >
						<span class="help-block"><?php echo form_error('familyname_ar');?></span>
					</div>
				</div>
				<div class="col-md-3">
					<label  class="control-label lbl-arabic"><?php echo Base_Controller::ToggleLang('Surname','ar');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="surname_ar" id="surname_ar" class="form-control" value="<?php echo $form->surname_ar;?>" >
						<span class="help-block"><?php echo form_error('surname_ar');?></span>
					</div>
				</div>
				<div class="col-md-3">
					<label  class="control-label lbl-arabic"><?php echo Base_Controller::ToggleLang('Middle Name', 'ar');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="middle_name_ar" id="middle_name_ar" class="form-control" value="<?php echo $form->middle_name_ar;?>" >
						<span class="help-block"><?php echo form_error('middle_name_ar');?></span>
					</div>
				</div>
				<div class="col-md-3">
					<label  class="control-label lbl-arabic"><?php echo Base_Controller::ToggleLang('First Name', 'ar');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="first_name_ar" id="first_name_ar" class="form-control" value="<?php echo $form->first_name_ar;?>" >
						<span class="help-block"><?php echo form_error('first_name_ar');?></span>
					</div>
				</div>
				
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('First Name');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $form->first_name;?>" >
						<span class="help-block"><?php echo form_error('first_name');?></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Middle Name');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="middle_name" id="middle_name" class="form-control" value="<?php echo $form->middle_name;?>" >
						<span class="help-block"><?php echo form_error('middle_name');?></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Surname');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="surname" id="surname" class="form-control" value="<?php echo $form->surname;?>" >
						<span class="help-block"><?php echo form_error('surname');?></span>
					</div>
				</div>
				<input type="hidden" name="employee_name" id="employee_name" class="form-control" value="<?php echo $form->employee_name;?>" >
			</div>
			
			<div class="form-group">
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Father Name');?></label>
					<div class="form-group">
						<input type="text" id="father_name" name="father_name" class="form-control" value="<?php echo $form->father_name;?>" placeholder="">
						<span class="help-block"></span>
					</div>
				</div>
				
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Gender');?></label>
					<div class="form-group">
						<div class="input-group">
							<div data-toggle="buttons" class="btn-group">
								<label class="btn blue <?php echo ($form->gender == 'M') ? 'active' : '';?>">
								<input type="radio" class="toggle" name="gender" id="gender_m" <?php echo ($form->gender == 'M') ? 'checked="checked"' : '';?>  value="M"> Male
								</label>
								<label class="btn blue <?php echo ($form->gender == 'F') ? 'active' : '';?>">
								<input type="radio" class="toggle" name="gender" id="gender_f" <?php echo ($form->gender == 'F') ? 'checked="checked"' : '';?> value="F"> Female
								</label>
							</div>
						</div>
						<span class="help-block"></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Marital Status');?></label>
					<div class="form-group">
						
						<div class="input-group">
							<div data-toggle="buttons" class="btn-group">
								<label class="btn blue <?php echo ($form->marital_status == 'S') ? 'active' : '';?>">
								<input type="radio" class="toggle" name="marital_status" id="marital_status_s" <?php echo ($form->marital_status == 'S') ? 'checked="checked"' : '';?> value="S"> Single
								</label>
								<label class="btn blue <?php echo ($form->marital_status == 'M') ? 'active' : '';?>">
								<input type="radio" class="toggle" name="marital_status" id="marital_status_m" <?php echo ($form->marital_status == 'M') ? 'checked="checked"' : '';?> value="M"> Married
								</label>
							</div>
						</div>
						<span class="help-block"><?php echo form_error('marital_status');?></span>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Date of birth');?></label>
					<div class="form-group">
						<input type="text" id="date_of_birth" name="date_of_birth" class="form-control form-control-inline date-picker" value="<?php echo util::displayFormat($form->date_of_birth);?>" data-date-format="dd-mm-yyyy" size="16" placeholder="D-M-Y">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label">Iqama / ID</label>
					<div class="form-group">
						<input type="text" id="iqama_id" name="iqama_id" value="<?php echo $form->iqama_id;?>" class="form-control" placeholder="9999999999">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label">Iqama / ID Expiry</label>
					<div class="form-group">
						<input type="text" id="iqama_expiry" name="iqama_expiry" class="form-control form-control-inline date-picker" value="<?php echo util::displayFormat($form->iqama_expiry);?>" data-date-format="dd-mm-yyyy" size="16" placeholder="D-M-Y" />
						<span class="help-block"></span>
					</div>
				</div>
				
			</div>
			<div class="clearfix"></div>
			<div class="form-group">
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Passport #');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" id="passport_id" name="passport_id" class="form-control" value="<?php echo $form->passport_id;?>" placeholder="">
						<span class="help-block"></span>
					</div>
				</div>
				
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Passport Expiry');?></label>
					<div class="form-group">
						<input type="text" name="passport_expiry" id="passport_expiry" class="form-control form-control-inline date-picker" value="<?php echo util::displayFormat($form->passport_expiry);?>" data-date-format="dd-mm-yyyy" size="16" placeholder="D-M-Y"/>
						<span class="help-block"></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Passport (Place of Issue)');?></label>
					<div class="form-group">
						<input type="text" name="passport_place_issue" id="passport_place_issue" class="form-control" value="<?php echo $form->passport_place_issue;?>" >
						<span class="help-block"><?php echo form_error('marital_status');?></span>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Local Address');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" id="local_address" name="local_address" class="form-control" placeholder="" value="<?php echo $form->local_address;?>">
						<span class="help-block"></span>
					</div>
				</div>
				
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Land Line');?></label>
					<div class="form-group">
						<input type="text" name="land_line" id="land_line" class="form-control" value="<?php echo $form->land_line;?>" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Mobile No');?></label>
					<div class="form-group">
						<input type="text" name="mobile_no" id="mobile_no" class="form-control" value="<?php echo $form->mobile_no;?>" >
						<span class="help-block"><?php echo form_error('mobile_no');?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Name of contact person');?></label>
					<div class="form-group">
						<input type="text" id="contact_person_name" name="contact_person_name" class="form-control" value="<?php echo $form->contact_person_name;?>" placeholder="">
						<span class="help-block">in case of emergency</span>
					</div>
				</div>
				
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Mobile no. of contact person');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="contact_person_mobile" id="contact_person_mobile" class="form-control" value="<?php echo $form->contact_person_mobile;?>" />
						<span class="help-block">in case of emergency</span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Email ID');?></label>
					<div class="form-group">
						<input type="text" name="email_id" id="email_id" class="form-control" value="<?php echo $form->email_id;?>" >
						<span class="help-block"><?php echo form_error('email_id');?></span>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group">
				<div class="col-md-4">
					<label  class="control-label">Department</label>
					<div class="form-group">
						<select  class="form-control" name="department_id">
							<?php foreach($dept_list as $dept){ 
								$dept_id = $dept->department_id;
								?> 
								<option value="<?php echo $dept_id;?>" <?php if($dept_id ==  $form->department_id) echo 'selected'; ?> ><?php echo $dept->name;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				
				<div class="col-md-4">
					<label class="control-label">Designation</label>
					<div class="form-group">
						<select class="form-control" id="designation" name="designation">
							<option <?php if($form->designation == 'Teacher') echo 'selected';?> value="Teacher" selected ><?php echo 'Teacher';?></option>
		                    <option <?php if($form->designation == 'Class Incharge') echo 'selected';?> value="Class Incharge"><?php echo 'Class Incharge';?></option>
		                    <option <?php if($form->designation == 'Employee') echo 'selected';?> value="Employee"><?php echo 'Employee';?></option>
		                    <option <?php if($form->designation == 'Grade IV') echo 'selected';?> value="Grade IV"><?php echo 'Grade IV';?></option>
		                    <option <?php if($form->designation == 'Other') echo 'selected';?> value="Other"><?php echo 'Other';?></option>
						</select>
					</div>
				</div>
				
				<div class="col-md-4">
					<?php if($form->designation == 'Teacher') {?>
					<label class="control-label"><?php echo Base_Controller::ToggleLang('Course').' / '. Base_Controller::ToggleLang('Section');?>:</label>
					<div class="form-group">
						<div class="col-md-7">
						<select name="course_id" class="form-control" id="course_id" tabindex="1" >
		                    <option value="<?php echo $form->surname;?>" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
		                    <?php foreach($courses_list as $course){ 
		                    	$course_id = $course->course_id;
		                    	?> 
		                    	<option value="<?php echo $course_id;?>" <?php if($form->course_id == $course_id) echo 'selected';?> ><?php echo $course->course_name;?></option>
		                    <?php } ?>
						</select></div>
						<div class="col-md-5">
						<select name="section" class="form-control" id="section" tabindex="1" >
		                    <option value="" selected><?php echo Base_Controller::ToggleLang('SELECT'); ?></option>
		                    <option value="A" <?php if($form->section == 'A') echo 'selected';?> > A </option>
		                    <option value="B" <?php if($form->section == 'B') echo 'selected';?> > B </option>
		                    <option value="C" <?php if($form->section == 'C') echo 'selected';?> > C </option>
		                    <option value="D" <?php if($form->section == 'D') echo 'selected';?> > D </option>
		                    <option value="E" <?php if($form->section == 'E') echo 'selected';?> > E </option>
                            <option value="F" <?php if($form->section == 'F') echo 'selected';?>> F </option>
		                    <option value="G" <?php if($form->section == 'G') echo 'selected';?>> G </option>
		                    <option value="H" <?php if($form->section == 'H') echo 'selected';?>> H </option>
		                    <option value="I" <?php if($form->section == 'I') echo 'selected';?>> I </option>
						</select></div>
					</div>
					<?php } ?>
				</div>							
				
			</div>
			<div class="clearfix"></div>
			<!--  
			<div class="form-group">
				<div class="col-md-4">
					<label  class="control-label">Pay Scale / Grade</label>
					<div class="form-group">
						<select  class="form-control" name="grade_id" id="grade_id">
							<?php foreach($grade_list as $grade){ 
								$grade_id = $grade->grade_id;
								?> 
								<option value="<?php echo $grade_id;?>" <?php if($grade_id == $form->grade_id ) echo 'selected'; ?> ><?php echo $grade->grade_name;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-4"></div>
				<div class="col-md-4"></div>
			</div>-->
			<div class="form-group">
				<label class="control-label col-md-2"><?php echo Base_Controller::ToggleLang('Check List');?>:</label>
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
					<label><input type="checkbox" name="option01" id="option01" <?php if(isset($check_list[1])) echo 'checked="checked"';?>>
					Copy of Degree Certificate</label><br>
					<label><input type="checkbox" name="option02" id="option02" <?php if(isset($check_list[2])) echo 'checked="checked"';?>>
					Copy of Experience Certificate</label><br>
					<label><input type="checkbox" name="option03" id="option03" <?php if(isset($check_list[3])) echo 'checked="checked"';?>>
					Copy of Ministry License (if any)</label><br>
					<label><input type="checkbox" name="option04" id="option04" <?php if(isset($check_list[4])) echo 'checked="checked"';?>>
					Copy of ID/Iqama</label><br>
					<label><input type="checkbox" name="option05" id="option05" <?php if(isset($check_list[5])) echo 'checked="checked"';?>>
					Copy of Passport</label><br>
					<label><input type="checkbox" name="option06" id="option06" <?php if(isset($check_list[6])) echo 'checked="checked"';?>>
					Medical Certificate</label><br>
					<label><input type="checkbox" name="option07" id="option07" <?php if(isset($check_list[7])) echo 'checked="checked"';?>>
					Introduction Letter from the Sponsor</label><br>
					<label><input type="checkbox" name="option08" id="option08" <?php if(isset($check_list[8])) echo 'checked="checked"';?>>
					Copy of sponsor's Iqama</label>
				</div>
				<div class="col-md-3">&nbsp;</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group">
				<label class="control-label col-md-2"><?php echo Base_Controller::ToggleLang('Attach files');?>:</label>
				<div class="col-md-6" style="text-align: left">
					<input type="file" name="files[]" id="files0" multiple="multiple" size="20" onchange="getFileSizeandName(this);" >
					<span class="col-md-6" id="filecount"></span> <span class="col-md-6" id="totalsize"></span>
					
					<label class="control-label" style="text-align: left"><?php echo Base_Controller::ToggleLang('Max. size for upload files at once is') . " " . ini_get("upload_max_filesize").'B';?></label>
				</div>
			</div>
			<!--<div class="form-group">
				<div class="col-md-4">
					<label  class="control-label">Status</label>
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
				<div class="col-md-8"></div>
			</div>-->
			<div class="clearfix"></div>
			<div class="form-actions fluid">
				<div class="col-md-offset-3 col-md-9">
					<button type="button" class="btn blue" onclick="submitForm()" ><i class="fa fa-check"></i> Submit</button>
					<button type="button" class="btn default" onclick="window.open('<?php echo base_url().$model;?>', '_self')" >Cancel</button>                              
				</div>
			</div>
			<input type="hidden" name="academic_row_added" id="academic_row_added" value="4" />
			<input type="hidden" name="exp_row_added" id="exp_row_added" value="4" />
			
		</div>
	</div>
	<div class="clearfix"></div>