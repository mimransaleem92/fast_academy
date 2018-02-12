<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-home"></i><?php echo "Enrollment Form";?>
				</div>
			</div>
			<div class="portlet-body" style="height:100%">
				<div class="col-md-1"></div>
				<div class="col-md-9">
				<?php $today = date('Y-m-d'); echo form_open('student/add',array('id'=>'mainForm', 'class'=>"form-horizontal")); ?>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Student full name');?>:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="student_name" name="student_name" value='' placeholder="<?php echo Base_Controller::ToggleLang('Student full name');?>">
								<span class="help-block">As shown in Passport</span>
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Student full name', 'ar');?></label>
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
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Gender', 'ar');?></label>
						</div>
					</div>
				</div> -->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Date of birth').' / '.Base_Controller::ToggleLang('Age').' / '.Base_Controller::ToggleLang('Gender');?>:</label>
							<div class="col-md-2">
								<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="date_of_birth" name="date_of_birth" value='' placeholder="<?php echo Base_Controller::ToggleLang('Date of birth');?>">
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
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Date of birth', 'ar').' / '.Base_Controller::ToggleLang('Age', 'ar').' / '.Base_Controller::ToggleLang('Gender', 'ar');?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Nationality');?>:</label>
							<div class="col-md-6">
								<select name="nationality" class="form-control" id="nationality" >
									<?php foreach($country_list as $country){ 
										$country_id = $country->id;
										?> 
										<option value="<?php echo $country_id;?>" <?php if($country_id ==  '187') echo 'selected'; ?> ><?php if($lang == 'ar') echo $country->country_ar; else echo $country->country_name;?></option>
									<?php } ?>
								</select>
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Nationality', 'ar');?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('ID Number').' / '.Base_Controller::ToggleLang('Expiry Date');?>:</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="iqama_id" name="iqama_id" value='' placeholder="<?php echo Base_Controller::ToggleLang('ID Number');?>">
								
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control form-control-inline date-picker" data-required="1"  data-date-format="dd-mm-yyyy" size="10" placeholder="dd-mm-yyyy" readonly="readonly" id="iqama_expiry" name="iqama_expiry" value='' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('ID Number', 'ar').' / '.Base_Controller::ToggleLang('Expiry Date', 'ar');?></label>
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
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Passport Number', 'ar').' / '.Base_Controller::ToggleLang('Expiry Date', 'ar');?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Enrollment Grade').' / '.Base_Controller::ToggleLang('Date');?>:</label>
							<div class="col-md-4">
								<select name="course_id" class="form-control" id="course_id" data-placeholder="Choose a Course" tabindex="1" > <!-- onchange="onchange_courses(this.value)"> -->
				                    <option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
				                    <?php foreach($courses_list as $course){ 
				                    	$course_id = $course->course_id; 
				                    	if($course_id > 15) continue;
				                    	?> 
				                    	<option value="<?php echo $course_id;?>" <?php if(isset($_POST['course_id']) && $_POST['course_id'] == $course_id) echo 'selected';?> ><?php echo $course->course_name;?></option>
				                    <?php } ?>
								</select>
							</div>
							<div class="col-md-2">
								<input type="text" class="form-control" readonly="readonly" id="enrollment_date" name="enrollment_date" value='<?php echo Util::displayFormat($today);?>' placeholder="<?php echo Base_Controller::ToggleLang('00-00-0000');?>">
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Enrollment Grade', 'ar').' / '.Base_Controller::ToggleLang('Date', 'ar');?></label>
						</div>
					</div>
				</div>
				<!-- Father Info -->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Father full name');?>:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="father_name" name="father_name" value='' placeholder="<?php echo Base_Controller::ToggleLang('Father full name');?>">
								<span class="help-block">As shown in Passport</span>
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Father full name', 'ar');?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Occupation');?>:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="occupation" name="occupation" value='' placeholder="<?php echo Base_Controller::ToggleLang('Occupation');?>">
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Occupation', 'ar');?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Work Place');?>:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="work_place_father" id="work_place_father" value='<?php if(isset($_POST['work_place_father'])) echo $_POST['work_place_father']; ?>'>
								 
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Work Place','ar');?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('ID Number');?>:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="id_number_father" id="id_number_father" value='<?php if(isset($_POST['id_number_father'])) echo $_POST['id_number_father']; ?>'>
								 
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('ID Number','ar');?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Work Phone');?>:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="work_phone_father" id="work_phone_father" value='<?php if(isset($_POST['work_phone_father'])) echo $_POST['work_phone_father']; ?>'>
								 
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Work Phone','ar');?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Cell Phone');?>:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="cell_phone_father" id="cell_phone_father" value='<?php if(isset($_POST['cell_phone_father'])) echo $_POST['cell_phone_father']; ?>'>
								 
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Cell Phone','ar');?></label>
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
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Email','ar');?></label>
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
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Mother full name', 'ar');?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Occupation');?>:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="occupation" name="occupation" value='' placeholder="<?php echo Base_Controller::ToggleLang('Occupation');?>">
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Occupation', 'ar');?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Work Place');?>:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="work_place_mother" id="work_place_mother" value='<?php if(isset($_POST['work_place_mother'])) echo $_POST['work_place_mother']; ?>'>
								 
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Work Place','ar');?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('ID Number');?>:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="id_number_mother" id="id_number_mother" value='<?php if(isset($_POST['id_number_mother'])) echo $_POST['id_number_mother']; ?>'>
								 
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('ID Number','ar');?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Work Phone');?>:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="work_phone_mother" id="work_phone_mother" value='<?php if(isset($_POST['work_phone_mother'])) echo $_POST['work_phone_mother']; ?>'>
								 
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Work Phone','ar');?></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Cell Phone');?>:</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="cell_phone_mother" id="cell_phone_mother" value='<?php if(isset($_POST['cell_phone_mother'])) echo $_POST['cell_phone_mother']; ?>'>
								 
							</div>
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Cell Phone','ar');?></label>
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
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Email','ar');?></label>
						</div>
					</div>
				</div>
				
				<div class="form-actions fluid">
					<div class="col-md-offset-3 col-md-9">
						<button type="button" class="btn blue" onclick="submitForm()" ><i class="fa fa-check"></i> Submit</button>
						<button type="button" class="btn default" onclick="window.open('<?php echo base_url();?>', '_self')" >Cancel</button>                              
					</div>
				</div>
				
				</div>
				<div class="col-md-2"></div>
				<div class="clearfix"></div>
			</div>
		</div>	
	</div>
</div>			

<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/scripts/index.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/global/scripts/ajax.js"></script>
<script>
	jQuery(document).ready(function() {    
	    App.init(); // initlayout and core plugins
	    Index.init();
		$('.date-picker').datepicker({
            //rtl: Metronic.isRTL(),
            orientation: "left",
            autoclose: true
        });

		function submitForm(){
			document.getElementById('mainForm').submit();
		}
	});	
</script>