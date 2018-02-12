
	<div class="clearfix"></div>
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption" ><?php echo Base_Controller::ToggleLang('Personal Information');?></div>
			<div class="tools" ><?php echo Base_Controller::ToggleLang('Personal Information', 'ar');?></div>
		</div>
		<div class="portlet-body" >
			<div class="form-group">
				<div class="col-md-3">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Attendance Log ID NO');?></label>
					<div class="form-group">
						<input type="text" id="attendance_log_id" name="attendance_log_id" class="form-control" size="20" >
					</div>
				</div>
				
				<div class="col-md-3">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Joining Date');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="joining_date" id="joining_date" class="form-control form-control-inline date-picker"  data-date-format="dd-mm-yyyy" size="16" value="" placeholder="D-M-Y"/>
						<span class="help-block"></span>
					</div>
				</div>
				<div class="col-md-3">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('School');?></label>
					<div class="form-group">
					<select  class="form-control" name="division_id" id="division_id" >
						<?php 
							$curr_div = 1;
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
						<input type="text" name="familyname_ar" id="familyname_ar" class="form-control" value="<?php if(isset($_POST['familyname_ar'])) echo $_POST['familyname_ar'];?>" >
						<span class="help-block"><?php echo form_error('familyname_ar');?></span>
					</div>
				</div>
				<div class="col-md-3">
					<label  class="control-label lbl-arabic"><?php echo Base_Controller::ToggleLang('Surname','ar');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="surname_ar" id="surname_ar" class="form-control" value="<?php if(isset($_POST['surname_ar'])) echo $_POST['surname'];?>" >
						<span class="help-block"><?php echo form_error('surname_ar');?></span>
					</div>
				</div>
				<div class="col-md-3">
					<label  class="control-label lbl-arabic"><?php echo Base_Controller::ToggleLang('Middle Name', 'ar');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="middle_name_ar" id="middle_name_ar" class="form-control" value="<?php if(isset($_POST['middle_name_ar'])) echo $_POST['middle_name_ar'];?>" >
						<span class="help-block"><?php echo form_error('middle_name_ar');?></span>
					</div>
				</div>
				<div class="col-md-3">
					<label  class="control-label lbl-arabic"><?php echo Base_Controller::ToggleLang('First Name', 'ar');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="first_name_ar" id="first_name_ar" class="form-control" value="<?php if(isset($_POST['first_name_ar'])) echo $_POST['first_name_ar'];?>" >
						<span class="help-block"><?php echo form_error('first_name_ar');?></span>
					</div>
				</div>
				
			</div>
			
			<div class="form-group">
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('First Name');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo set_value('first_name');?>" >
						<span class="help-block"><?php echo form_error('first_name');?></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Middle Name');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="middle_name" id="middle_name" class="form-control" value="<?php echo set_value('middle_name');?>" >
						<span class="help-block"><?php echo form_error('middle_name');?></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Surname');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="surname" id="surname" class="form-control" value="<?php echo set_value('surname');?>" >
						<span class="help-block"><?php echo form_error('surname');?></span>
					</div>
				</div>
				<input type="hidden" name="employee_name" id="employee_name" class="form-control" value="" >
			</div>
			
			<div class="form-group">
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Father Name');?></label>
					<div class="form-group">
						<input type="text" id="father_name" name="father_name" class="form-control" placeholder="">
						<span class="help-block"></span>
					</div>
				</div>
				
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Gender');?></label>
					<div class="form-group">
						<div class="input-group">
							<div data-toggle="buttons" class="btn-group">
								<label class="btn blue active">
								<input type="radio" class="toggle" name="gender" id="gender_m" checked="checked" value="M"> Male
								</label>
								<label class="btn blue">
								<input type="radio" class="toggle" name="gender" id="gender_f" value="F"> Female
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
								<label class="btn blue active">
								<input type="radio" class="toggle" name="marital_status" id="marital_status_s" checked="checked" value="S"> Single
								</label>
								<label class="btn blue">
								<input type="radio" class="toggle" name="marital_status" id="marital_status_m" value="M"> Married
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
						<input type="text" id="date_of_birth" name="date_of_birth" class="form-control form-control-inline date-picker"  data-date-format="dd-mm-yyyy" size="16" placeholder="D-M-Y">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label">Iqama / ID</label>
					<div class="form-group">
						<input type="text" id="iqama_id" name="iqama_id" class="form-control" value="" placeholder="9999999999">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label">Iqama / ID Expiry</label>
					<div class="form-group">
						<input type="text" id="iqama_expiry" name="iqama_expiry" class="form-control form-control-inline date-picker"  data-date-format="dd-mm-yyyy" size="16" value='<?php echo date('d-m-Y');?>' placeholder="D-M-Y" />
						<span class="help-block"></span>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group">
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Passport #');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" id="passport_id" name="passport_id" class="form-control" placeholder="">
						<span class="help-block"></span>
					</div>
				</div>
				
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Passport Expiry');?></label>
					<div class="form-group">
						<input type="text" name="passport_expiry" id="passport_expiry" class="form-control form-control-inline date-picker"  data-date-format="dd-mm-yyyy" size="16" value="" placeholder="D-M-Y"/>
						<span class="help-block"></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Passport (Place of Issue)');?></label>
					<div class="form-group">
						<input type="text" name="passport_place_issue" id="passport_place_issue" class="form-control" value="<?php echo set_value('passport_place_issue');?>" >
						<span class="help-block"><?php echo form_error('marital_status');?></span>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Local Address');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" id="local_address" name="local_address" class="form-control" placeholder="">
						<span class="help-block"></span>
					</div>
				</div>
				
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Land Line');?></label>
					<div class="form-group">
						<input type="text" name="land_line" id="land_line" class="form-control" value="" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Mobile No');?></label>
					<div class="form-group">
						<input type="text" name="mobile_no" id="mobile_no" class="form-control" value="<?php echo set_value('mobile_no');?>" >
						<span class="help-block"><?php echo form_error('mobile_no');?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Name of contact person');?></label>
					<div class="form-group">
						<input type="text" id="contact_person_name" name="contact_person_name" class="form-control" placeholder="">
						<span class="help-block">in case of emergency</span>
					</div>
				</div>
				
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Mobile no. of contact person');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="contact_person_mobile" id="contact_person_mobile" class="form-control" value="" />
						<span class="help-block">in case of emergency</span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Email ID');?></label>
					<div class="form-group">
						<input type="text" name="email_id" id="email_id" class="form-control" value="<?php echo set_value('email_id');?>" >
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
								<option value="<?php echo $dept_id;?>" <?php if($dept_id ==  $this->session->userdata('dept_id')) echo 'selected'; ?> ><?php echo $dept->name;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				
				<div class="col-md-4">
					<label class="control-label">Designation</label>
					<div class="form-group">
						<select class="form-control" id="designation" name="designation">
							<option value="Teacher" selected ><?php echo 'Teacher';?></option>
		                    <option value="Class Incharge"><?php echo 'Class Incharge';?></option>
		                    <option value="Employee"><?php echo 'Employee';?></option>
		                    <option value="Grade IV"><?php echo 'Grade IV';?></option>
		                    <option value="Other"><?php echo 'Other';?></option>
						</select>
					</div>
				</div>
				
				<div class="col-md-4">
					<label class="control-label"><?php echo Base_Controller::ToggleLang('Course').' / '. Base_Controller::ToggleLang('Section');?>:</label>
					<div class="form-group">
						<div class="col-md-7">
						<select name="course_id" class="form-control" id="course_id" tabindex="1" >
		                    <option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
		                    <?php foreach($courses_list as $course){ 
		                    	$course_id = $course->course_id;
		                    	?> 
		                    	<option value="<?php echo $course_id;?>" <?php if(isset($_POST['course_id']) && $_POST['course_id'] == $course_id) echo 'selected';?> ><?php echo $course->course_name;?></option>
		                    <?php } ?>
						</select></div>
						<div class="col-md-5">
						<select name="section" class="form-control" id="section" tabindex="1" >
		                    <option value="" selected><?php echo Base_Controller::ToggleLang('SELECT'); ?></option>
		                    <option value="A" <?php if(isset($_POST['section']) && $_POST['section'] == 'A') echo 'selected';?> > A </option>
		                    <option value="B" <?php if(isset($_POST['section']) && $_POST['section'] == 'B') echo 'selected';?> > B </option>
		                    <option value="C" <?php if(isset($_POST['section']) && $_POST['section'] == 'C') echo 'selected';?> > C </option>
		                    <option value="D" <?php if(isset($_POST['section']) && $_POST['section'] == 'D') echo 'selected';?> > D </option>
		                    <option value="E" <?php if(isset($_POST['section']) && $_POST['section'] == 'E') echo 'selected';?> > E </option>
                            <option value="F" <?php if(isset($_POST['section']) && $_POST['section'] == 'F') echo 'selected';?>> F </option>
		                    <option value="G" <?php if(isset($_POST['section']) && $_POST['section'] == 'G') echo 'selected';?>> G </option>
		                    <option value="H" <?php if(isset($_POST['section']) && $_POST['section'] == 'H') echo 'selected';?>> H </option>
		                    <option value="I" <?php if(isset($_POST['section']) && $_POST['section'] == 'I') echo 'selected';?>> I </option>
						</select></div>
					</div>
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
								<option value="<?php echo $grade_id;?>" <?php if($grade_id == 10 ) echo 'selected'; ?> ><?php echo $grade->grade_name;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-4"></div>
				<div class="col-md-4"></div>
			</div>
			 -->
			<div class="form-group">
				<label class="control-label col-md-2"><?php echo Base_Controller::ToggleLang('Check List');?>:</label>
				<div class="col-md-6" style="text-align: left">
					<label><input type="checkbox" name="option01" id="option01">
					Copy of Degree Certificate</label><br>
					<label><input type="checkbox" name="option02" id="option02">
					Copy of Experience Certificate</label><br>
					<label><input type="checkbox" name="option03" id="option03">
					Copy of Ministry License (if any)</label><br>
					<label><input type="checkbox" name="option04" id="option04">
					Copy of ID/Iqama</label><br>
					<label><input type="checkbox" name="option05" id="option05">
					Copy of Passport</label><br>
					<label><input type="checkbox" name="option06" id="option06">
					Medical Certificate</label><br>
					<label><input type="checkbox" name="option07" id="option07">
					Introduction Letter from the Sponsor</label><br>
					<label><input type="checkbox" name="option08" id="option08">
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
			
			<!-- <div class="form-group">
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
			</div> -->
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