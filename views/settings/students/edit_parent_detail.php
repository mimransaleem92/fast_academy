<?php 
if(sizeof($guardian)>0){
	$parent = $guardian[0];
}
?>
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-reorder"></i><?php echo Base_Controller::ToggleLang('Parent Info');?></div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php echo form_open('students/add_parent_data_update',array('id'=>'parentDetailForm', 'class'=>"form-horizontal")); $today    = date('Y-m-d'); ?>
			<div class="form-body">
				<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Parent - Personal Details');?></h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('First Name');?>:</label>
							<div class="col-md-9">
								<input type="hidden" class="form-control" id="id" name="id" value='<?php echo $parent->student_guardian_id;?>' />
								<input type="hidden" class="form-control" id="student_id" name="student_id" value='<?php echo $parent->student_id;?>' />
								<input type="text" class="form-control" id="first_name" name="first_name" value='<?php echo $parent->first_name;?>' placeholder="<?php echo Base_Controller::ToggleLang('First Name');?>" onblur="document.getElementById('iqama_name').value = this.value + ' ' + parentDetailForm.last_name.value " />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Last Name');?>:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="last_name" name="last_name" value='<?php echo $parent->last_name;?>' placeholder="<?php echo Base_Controller::ToggleLang('Last Name');?>" onblur="document.getElementById('iqama_name').value = parentDetailForm.first_name.value + ' ' + this.value" />
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
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Relation');?>:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="relation" name="relation" value='<?php echo $parent->relation;?>' placeholder="<?php echo Base_Controller::ToggleLang('Relation');?>" />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<!--<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Gender');?>:</label>
							<div class="col-md-9">
								<select class="form-control" name="gender" id='gender'>
									<option value=""><?php echo Base_Controller::ToggleLang('Male');?></option>
									<option value=""><?php echo Base_Controller::ToggleLang('Female');?></option>
								</select>
								<span class="help-block">Select your gender.</span>
							</div>
						</div>-->
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Education');?>:</label>
							<div class="col-md-9">
								<input type="text" name="education" id="education" class="form-control " value="<?php echo $parent->education;?>" placeholder="Education" />
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Date of Birth');?>:</label>
							<div class="col-md-9">
								<input type="text" name="date_of_birth" id="parent_date_of_birth" value="<?php if($parent->date_of_birth != '0000-00-00') echo Util::dateDisplayFormate($parent->date_of_birth);?>" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="16" placeholder="dd-mm-yyyy" />
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Income');?>:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="income" id="income" maxlength="20" value='<?php echo $parent->income;?>' placeholder="<?php echo Base_Controller::ToggleLang('Income');?>"/>
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Occupation');?>:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="occupation" id="occupation" value='<?php echo $parent->occupation;?>' placeholder="<?php echo Base_Controller::ToggleLang('Occupation');?>">
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				
				<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Parent - Contact Details');?></h3>
				<!--/row-->                   
				<!--<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label col-md-12"><?php echo Base_Controller::ToggleLang('Email');?></label>
							<div class="col-md-12"><input type="text" class="form-control" name="email" id="email" value="" ></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label col-md-12"><?php echo Base_Controller::ToggleLang('Office Phone1');?></label>
							<div class="col-md-12"><input type="text" class="form-control" name="office_phone1" id="office_phone1" value='' ></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label col-md-12"><?php echo Base_Controller::ToggleLang('Office Phone2');?></label>
							<div class="col-md-12"><input type="text" class="form-control" name="office_phone2" id="office_phone2" value='' ></div>
						</div>
					</div>
				</div>--> 
				<!--/row-->                   
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Email');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="email" id="email" value='<?php echo $parent->email;?>' >
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Mobile');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="mobile_phone" id="mobile_phone" value='<?php echo $parent->mobile_phone;?>' >
							</div>
						</div>
					</div>
				</div>
				<!--/row-->                   
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Office Phone1');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="office_phone1" id="office_phone1" value='<?php echo $parent->office_phone1;?>' >
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Office Phone1');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="office_phone2" id="office_phone2" value='<?php echo $parent->office_phone2;?>' >
							</div>
						</div>
					</div>
				</div>
				<!--/row-->                   
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Address Line1');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="office_address_line1" id="office_address_line1" value='<?php echo $parent->office_address_line1;?>'>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Address Line2');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="office_address_line2" id="office_address_line2" value='<?php echo $parent->office_address_line2;?>' >
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('City / Town');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="city" id="city" value='<?php echo $parent->city;?>'> 
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						
					</div>
					<!--/span-->
				</div>
				<!--/row-->           
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('State / Province');?></label>
							<div class="col-md-9">
								<input type="text"  class="form-control" name="state" id="state" value='<?php echo $parent->state;?>'> 
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Country');?></label>
							<div class="col-md-9">
								<select class="form-control" name="country" id="country_id">
									<?php foreach($country_list as $country){ 
										$country_id = $country->iso3;
										?> 
										<option value="<?php echo $country_id;?>" <?php if($country_id ==  $parent->country) echo 'selected'; ?> ><?php if($lang == 'ar') echo $country->country_ar; else echo $country->country_name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Iqama / Passport Info');?></h3>
				<!--/row-->                   
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Name');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="iqama_name" id="iqama_name" value='<?php echo $parent->iqama_name;?>' />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Profession');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="profession" id="profession" value='<?php echo $parent->profession;?>' />
							</div>
						</div>
					</div>
				</div>
				<!--/row-->                   
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Iqama ID');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="iqama_id" id="iqama_id" maxlength="10" value='<?php echo $parent->iqama_id;?>' />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Passport ID');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="passport_id" id="passport_id" value='<?php echo $parent->passport_id;?>' />
							</div>
						</div>
					</div>
				</div>
				<!--/row-->                   
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Iqama Expiry');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="16" placeholder="dd-mm-yyyy" name="iqama_expiry" id="parent_iqama_expiry" maxlength="14" value='<?php if($parent->iqama_expiry != '0000-00-00') echo Util::dateDisplayFormate($parent->iqama_expiry);?>' />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Passport Expiry');?></label>
							<div class="col-md-9">
								<input type="text" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="16" placeholder="dd-mm-yyyy" name="passport_expiry" id="parent_passport_expiry" value='<?php if($parent->passport_expiry != '0000-00-00') echo Util::dateDisplayFormate($parent->passport_expiry);?>' />
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if($not_popup){?>
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
		<?php }
		echo form_close();?>
		<!-- END FORM-->                
		</div>
	</div>