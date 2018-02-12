<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption" ><?php echo Base_Controller::ToggleLang('Other Detail');?></div>
			<div class="tools" ><?php echo Base_Controller::ToggleLang('Other Detail', 'ar');?></div>
		</div>
		<div class="portlet-body" >
			<div class="form-group">
				<div class="col-md-5">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Sponsor Name');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="sponsor_name" id="sponsor_name" class="form-control" value="<?php echo $form->sponsor_name;?>" />
						<span class="help-block"></span>
					</div>
				</div>
				<div class="col-md-offset-2 col-md-5">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('How many child/children do you have in school?');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="number_of_chidren" id="number_of_chidren" data-required="1" class="form-control" value="<?php echo $form->number_of_chidren;?>" >
						<span class="help-block"><?php echo form_error('number_of_chidren');?></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				
				<div class="col-md-5">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Children name with Grade and Section');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="chidren_name" id="chidren_name" data-required="1" class="form-control" value="<?php echo $form->chidren_name;?>" >
						<span class="help-block"><?php echo form_error('chidren_name');?></span>
					</div>
				</div>
				<div class="col-md-offset-2 col-md-5">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Bank account Name (employees name)');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="bank_ac_name" id="bank_ac_name" data-required="1" class="form-control" value="<?php echo $form->bank_ac_name;?>" >
						<span class="help-block"><?php echo form_error('bank_ac_name');?></span>
					</div>
				</div>
				
			</div>
			<div class="form-group">
				
				<div class="col-md-5">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Bank Account Number');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="bank_ac_number" id="bank_ac_number" data-required="1" class="form-control" value="<?php echo $form->bank_ac_number;?>" >
						<span class="help-block"><?php echo form_error('bank_ac_number');?></span>
					</div>
				</div>
				<div class="col-md-offset-1 col-md-6">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('License for Ministry of Education');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="license_moe" id="license_moe" data-required="1" class="form-control" value="<?php echo $form->license_moe;?>" >
						<span class="help-block"><?php echo form_error('license_moe');?></span>
					</div>
				</div>
				
			</div>
			<div class="form-group">
				
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('insurance number');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="insurance_number" id="insurance_number" data-required="1" class="form-control" value="<?php echo $form->insurance_number;?>" >
						<span class="help-block"><?php echo form_error('insurance_number');?></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('insurance type');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="insurance_type" id="insurance_type" data-required="1" class="form-control" value="<?php echo $form->insurance_type;?>" >
						<span class="help-block"><?php echo form_error('insurance_type');?></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('insurance expiry');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="insurance_expiry" id="insurance_expiry" data-required="1" class="form-control form-control-inline date-picker"  data-date-format="dd-mm-yyyy" size="16" value="<?php echo $form->insurance_expiry;?>" >
						<span class="help-block"><?php echo form_error('insurance_expiry');?></span>
					</div>
				</div>
				
			</div>
			<div class="form-group">
				
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Visa Status');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="visa_status" id="visa_status" data-required="1" class="form-control" value="<?php echo $form->visa_status;?>" >
						<span class="help-block"><?php echo form_error('visa_status');?></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Annual leave entitlement');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="annual_leave_entitlement" id="annual_leave_entitlement" data-required="1" class="form-control" value="<?php echo $form->annual_leave_entitlement;?>" >
						<span class="help-block"><?php echo form_error('annual_leave_entitlement');?></span>
					</div>
				</div>
				<div class="col-md-4">
					<label  class="control-label"><?php echo Base_Controller::ToggleLang('Number of tickets');?><span class="required">*</span></label>
					<div class="form-group">
						<input type="text" name="number_of_tickets" id="number_of_tickets" data-required="1" class="form-control" placeholder="" value="<?php echo $form->number_of_tickets;?>" >
						<span class="help-block"><?php echo form_error('number_of_tickets');?></span>
					</div>
				</div>
				
			</div>
			<div class="form-group">
				<label  class="col-md-12 control-label"><?php echo Base_Controller::ToggleLang('Remarks');?></label>
				<div class="form-group col-md-12">
					<textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control" placeholder="Enter Remarks" ></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-5">
					<button type="button" class="btn blue" onclick="submitForm()" ><i class="fa fa-check"></i> Submit</button>
					<button type="button" class="btn default" onclick="window.open('<?php echo base_url().$model;?>', '_self')" >Cancel</button>
				</div>
				<div class="col-md-offset-2 col-md-5"> </div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>