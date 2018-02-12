<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css';?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/fonts/font.css';?>"/>
<style>
 .datemask { }
 	.control-lable-arabic{
	 	font-family: "Cantarell"; 
	 	text-align: left;
	 }
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
		<?php $today = date('Y-m-d'); echo form_open('enrollment/add', array('id'=>'mainForm', 'enctype'=>"multipart/form-data", 'class'=>"form-horizontal")); ?>
		<!-- <form action="#" id="mainForm" class="form-horizontal" method="post"> -->	
			<div class="form-body">
				<div class="alert alert-warning">
					<!-- <button class="close" data-close="alert"></button> -->
					Note: All fields in this form are mandatory!!
					<span style='font-family: "DroidKufi Regular", Tahoma; float: right;'><?php echo Base_Controller::ToggleLang('Note','ar').': '.Base_Controller::ToggleLang('All fields in this form are mandatory','ar');?></span>
				</div>
				<div class="alert alert-danger display-hide">
					<button class="close" data-close="alert"></button>
					<div id="error1">You have some form errors. Please check below.</div>
				</div>
				<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Personal Details');?></h3>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Student full name');?>:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="student_name" name="student_name" value='' placeholder="<?php echo Base_Controller::ToggleLang('Student full name');?>">
								<span class="help-block">As shown in Passport</span>
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control" style='font-family: Tahoma; text-align: right;' id="student_name_ar" name="student_name_ar" value='' placeholder="<?php echo Base_Controller::ToggleLang('Student Name', 'ar');?>">
							</div>
							<label class="control-label arabic col-md-3" style='font-family: Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Student full name', 'ar');?></label>
						</div>
					</div>
				</div>
				<!-- 
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Gender');?>:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" readonly="readonly" id="gender" name="gender" value='' placeholder="<?php echo Base_Controller::ToggleLang('Gender');?>">
								
							</div>
							<label class="control-label arabic col-md-3"><?php echo Base_Controller::ToggleLang('Gender', 'ar');?></label>
						</div>
					</div>
				</div> -->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Date of birth').' / '.Base_Controller::ToggleLang('Age').' / '.Base_Controller::ToggleLang('Gender');?>:</label>
							<div class="col-md-2">
								<input type="text" class="form-control form-control-inline" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="date_of_birth" name="date_of_birth" value='' onChange="calculateAge()" placeholder="<?php echo Base_Controller::ToggleLang('Date of birth');?>">
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control" readonly="readonly" id="age" name="age" value='' placeholder="<?php echo Base_Controller::ToggleLang('Age');?>">
							</div>
							<div class="col-md-2">
							
								<select class="form-control" name="gender" id='gender'>
									<option value=""><?php echo Base_Controller::ToggleLang('Male');?></option>
									<option value=""><?php echo Base_Controller::ToggleLang('Female');?></option>
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
										<option value="<?php echo $country_id;?>" <?php if($country_id ==  '187') echo 'selected'; ?> ><?php if($lang == 'ar') echo $country->country_ar; else echo $country->country_name;?></option>
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
								<input type="text" class="form-control" id="iqama_id" name="iqama_id" maxlength="10" value='' placeholder="<?php echo Base_Controller::ToggleLang('ID Number');?>">
								
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="iqama_expiry" name="iqama_expiry" value='' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
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
								<input type="text" class="form-control" id="passport_id" name="passport_id" value='' placeholder="<?php echo Base_Controller::ToggleLang('Passport Number');?>">
								
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="passport_expiry" name="passport_expiry" value='' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
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
								<select name="course_id" class="form-control" id="course_id" data-placeholder="Choose a Course" tabindex="1" onchange="onchange_courses(this)">
				                    <option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
				                    <?php foreach($courses_list as $course){ 
				                    	$course_id = $course->course_id; 
				                    	if($course_id > 15) continue;
				                    	?> 
				                    	<option value="<?php echo $course_id;?>" <?php if(isset($_POST['course_id']) && $_POST['course_id'] == $course_id) echo 'selected';?> ><?php echo $course->course_name;?></option>
				                    <?php } ?>
								</select>
								<input type="hidden" name="enrollment_grade_level" id="enrollment_grade_level" value="" />
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control" readonly="readonly" id="admission_date" name="admission_date" value='<?php echo Util::displayFormat($today);?>' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
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
											<input type="text" class="form-control" name="previous_school" id="previous_school" value="<?php if(isset($_POST['previous_school'])) echo $_POST['previous_school']; ?>" />
										</div>
										<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Previous School', 'ar');?></label>
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
							<div class="col-md-2">
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
							<div class="col-md-2"></div>
							<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left;'><?php echo Base_Controller::ToggleLang('Academic Year', 'ar').' / '.Base_Controller::ToggleLang('Term', 'ar');?></label>
						</div>
					</div>
				</div>
				<!-- 
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Sibling');?>:</label>
							<div class="form-group col-md-5">
								<div class="col-md-3">
									<div class="make-switch" data-on-label="Yes" data-off-label="No">
					
										<input type="checkbox" name="sibling" id="sibling" onchange="onchange_sibling(this)" class="toggle"/>
									</div>
								</div>	
								<div class="col-md-9">
									<input class="form-control input-sm" disabled="disabled" name="sibling_student_id" id="sibling_student_id" value="<?php if(isset($_POST['sibling_student_id'])) echo $_POST['sibling_student_id']; ?>" placeholder="Link Student"/>
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
										<input type="checkbox" name="employee_kid" id="employee_kid" onchange="onchange_employee_kid(this)" class="toggle"/>
									</div>
								</div>
								<div class="col-md-9">
									<input class="form-control input-sm" disabled="disabled" name="discount_on_employee_kid" id="discount_on_employee_kid" maxlength="2" style="text-align: right;" value="<?php if(isset($_POST['discount_on_employee_kid'])) echo $_POST['discount_on_employee_kid']; ?>" placeholder="Percent"/>
								</div>
							</div>
							<div class="col-md-1"></div>
							<label class="control-label col-md-3" style='font-family: "DroidKufi Regular", Tahoma; text-align: left; padding-left: 48px'><?php echo Base_Controller::ToggleLang('Employee Son', 'ar');?></label>
						</div>
					</div>
				</div> -->
				<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Parental Details');?></h3>
				<!-- Father Info -->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Father full name');?>:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="father_name" name="father_name" value='' placeholder="<?php echo Base_Controller::ToggleLang('Father full name');?>">
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
								<input type="text" class="form-control" id="occupation_father" name="occupation_father" value='' placeholder="<?php echo Base_Controller::ToggleLang('Occupation');?>">
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
								<input type="text" class="form-control" name="work_place_father" id="work_place_father" value='<?php if(isset($_POST['work_place_father'])) echo $_POST['work_place_father']; ?>'>
								 
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
								<input type="text" class="form-control" name="id_number_father" id="id_number_father" maxlength="10" value='<?php if(isset($_POST['id_number_father'])) echo $_POST['id_number_father']; ?>'>
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="iqama_expiry_father" name="iqama_expiry_father" value='' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
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
								<input type="text" class="form-control" name="passport_father" id="passport_father" value='<?php if(isset($_POST['passport_father'])) echo $_POST['passport_father']; ?>'>
								 
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="passport_expiry_father" name="passport_expiry_father" value='' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
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
								<input type="text" class="form-control" name="work_phone_father" id="work_phone_father" value='<?php if(isset($_POST['work_phone_father'])) echo $_POST['work_phone_father']; ?>'>
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control" name="cell_phone_father" id="cell_phone_father" value='<?php if(isset($_POST['cell_phone_father'])) echo $_POST['cell_phone_father']; ?>'>
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
								<input type="text" class="form-control" name="email_father" id="email_father" value='<?php if(isset($_POST['email_father'])) echo $_POST['email_father']; ?>'>
								 
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
								<input type="text" class="form-control" id="mother_name" name="mother_name" value='' placeholder="<?php echo Base_Controller::ToggleLang('Mother full name');?>">
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
								<input type="text" class="form-control" id="occupation_mother" name="occupation_mother" value='' placeholder="<?php echo Base_Controller::ToggleLang('Occupation');?>">
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
								<input type="text" class="form-control" name="work_place_mother" id="work_place_mother" value='<?php if(isset($_POST['work_place_mother'])) echo $_POST['work_place_mother']; ?>'>
								 
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
								<input type="text" class="form-control" name="id_number_mother" id="id_number_mother" maxlength="10" value='<?php if(isset($_POST['id_number_mother'])) echo $_POST['id_number_mother']; ?>'>
								 
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="iqama_expiry_mother" name="iqama_expiry_mother" value='' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
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
								<input type="text" class="form-control" name="passport_mother" id="passport_mother" value='<?php if(isset($_POST['passport_mother'])) echo $_POST['passport_mother']; ?>'>
								 
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="passport_expiry_mother" name="passport_expiry_mother" value='' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
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
								<input type="text" class="form-control" name="work_phone_mother" id="work_phone_mother" value='<?php if(isset($_POST['work_phone_mother'])) echo $_POST['work_phone_mother']; ?>'>
								 
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control" name="cell_phone_mother" id="cell_phone_mother" value='<?php if(isset($_POST['cell_phone_mother'])) echo $_POST['cell_phone_mother']; ?>'>
								 
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
								<input type="text" class="form-control" name="email_mother" id="email_mother" value='<?php if(isset($_POST['email_mother'])) echo $_POST['email_mother']; ?>'>
								 
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
								<input type="text" class="form-control" name="address_line1" id="address_line1" value='<?php if(isset($_POST['address_line1'])) echo $_POST['address_line1']; ?>'>
								 
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
								<input type="text" class="form-control" name="emergency_contact_name" id="emergency_contact_name" placeholder="Name" value='<?php if(isset($_POST['emergency_contact_name'])) echo $_POST['emergency_contact_name']; ?>'>
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control" name="emergency_contact_relation" id="emergency_contact_relation" placeholder="Relation" value='<?php if(isset($_POST['emergency_contact_relation'])) echo $_POST['emergency_contact_relation']; ?>'>
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control" name="emergency_contact" id="emergency_contact" placeholder="Contact #" value='<?php if(isset($_POST['emergency_contact'])) echo $_POST['emergency_contact']; ?>'>
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
								<label><input type="checkbox" name="option01" id="option01">
								Copy of student's passport</label><br>
								<label><input type="checkbox" name="option02" id="option02">
								Copy of father's passport</label><br>
								<label><input type="checkbox" name="option03" id="option03">
								Copy of student's identification card (Bitaqa, Iqama)</label><br>
								<label><input type="checkbox" name="option04" id="option04">
								Copy of father's identification card (Bitaqa, Iqama)</label><br>
								<label><input type="checkbox" name="option05" id="option05">
								Introduction Letter from Sponsor (Company)</label><br>
								<label><input type="checkbox" name="option06" id="option06">
								Copy of student's birth certificate</label><br>
								<label><input type="checkbox" name="option07" id="option07">
								Copy of student's vaccination certificate</label><br>
								<label><input type="checkbox" name="option08" id="option08">
								Financial Clearance Letter from the previous school</label><br>
								<label><input type="checkbox" name="option09" id="option09">
								Original Previous Report Cards  </label><br>
								<label><input type="checkbox" name="option10" id="option10">
								Admission Form (all information must be filled and signed by parents)</label><br>
								<label><input type="checkbox" name="option11" id="option11">
								Printout from Noor System</label><br>
								<label><input type="checkbox" name="option12" id="option12">
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
								<input type="text" class="form-control" name="remarks" id="remarks" value='<?php if(isset($_POST['remarks'])) echo $_POST['remarks']; ?>'>
								 
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
										<input type="checkbox" name="skip_validate" id="skip_validate" onchange="onchange_skip_validate(this)" class="toggle"/>
										
									</div>
								</div>
								<div class="col-md-9">
									<input class="form-control input-sm" disabled="disabled" name="skip_validate_note" id="skip_validate_note" maxlength="255" value="" placeholder="Note"/>
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
							<button type="button" class="btn green" onclick="validate_form()" ><i class="fa fa-check"></i> <?php echo Base_Controller::ToggleLang('Submit');?></button>
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

			var form1 = $('#mainForm');
			var error1 = $('.alert-danger', form1);
			function validate_form(){
				var skip_validate = document.getElementById('skip_validate');
				if(skip_validate.checked)
				{
					if(document.getElementById('skip_validate_note').value == ''){
						document.getElementById('skip_validate_span').innerHTML = 'Please enter note. Why are you skipping validation?';
						return false;
					}
					
					submitForm();
				}
				var std_grade = document.getElementById('course_id').value;
				var obj = document.getElementById('mainForm');
				for (i=0; i<obj.elements.length; i++) 
				{
					if (obj.elements[i].type == "text" && obj.elements[i].value == '') 
					{
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
					submitForm();
				}
			}
		
			var totalsizeOfUploadFiles = 0;
		    function getFileSizeandName(input)
		    {
		        var select = $('#uploadTable');
		        for(var i =0; i<input.files.length; i++)
		        {           
		            var filesizeInBytes = input.files[i].size;
		            var filesizeInMB = (filesizeInBytes / (1024*1024)).toFixed(2);
		            var filename = input.files[i].name;
		            //alert("File name is : "+filename+" || size : "+filesizeInMB+" MB || size : "+filesizeInBytes+" Bytes");
		            /*if(i<=4)
		            {               
		                $('#filetd'+i+'').text(filename);
		                $('#filesizetd'+i+'').text(filesizeInMB);
		            }
		            else if(i>4)
		                select.append($('<tr id=tr'+i+'><td id=filetd'+i+'>'+filename+'</td><td id=filesizetd'+i+'>'+filesizeInMB+'</td></tr>'));*/
		            totalsizeOfUploadFiles += parseFloat(filesizeInMB);
		            $('#totalsize').text("Size: " + totalsizeOfUploadFiles.toFixed(2)+" MB");
		            if(i==0)
		                $('#filecount').text("1 file selected");
		            else
		            {
		                var no = parseInt(i) + 1;
		                $('#filecount').text(no+" files selected");
		            }
		        }           
		    }

		    function calculateAge(){
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
		    
	        function onchange_courses(obj){
		        if(obj != ''){
			        val = obj.options[obj.selectedIndex].text;
		        	document.getElementById('enrollment_grade_level').value = val;
	        		//get('<?php echo base_url().'students/batches/';?>'+obj.value, '', 'td_batch','false','');
		        }
	        }

	        function onchange_sibling(obj){
	        	document.getElementById('sibling_student_id').disabled = true;
		        if(obj.checked){
		        	
		        	document.getElementById('sibling_student_id').disabled = false;
		        	document.getElementById('sibling_student_id').focus();
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
		