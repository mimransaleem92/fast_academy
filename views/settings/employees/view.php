<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>
<?php   $form = $form[0]; ?>

<div class="col-md-12">
    <div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Update Employee');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<!-- BEGIN FORM-->
			<?php echo form_open('employee/update',array('id'=>'mainForm', 'class'=>"form-horizontal")); 
				  echo form_hidden("employee_id",$form->employee_id);?>
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
								<input type="text" name="employee_name" data-required="1" class="form-control" placeholder="Enter Name" value="<?php echo $form->employee_name;?>" >
								<span class="help-block"><?php echo form_error('employee_name');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Father Name</label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" id="father_name" name="father_name" class="form-control" placeholder="Enter Father Name" value="<?php echo $form->father_name;?>">
								<span class="help-block"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Department</label>
						<div class="col-md-4">
							<div class="form-group">
								<select  class="form-control" name="department_id">
									<?php foreach($dept_list as $dept){ 
										$dept_id = $dept->department_id;
										?> 
										<option value="<?php echo $dept_id;?>" <?php if($dept_id ==  $form->department_id ) echo 'selected'; ?> ><?php echo $dept->name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>					
					<div class="form-group">
						<label class="control-label col-md-3">Designation</label>
						<div class="col-md-4">
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
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Pay Scale / Grade</label>
						<div class="col-md-4">
							<div class="form-group">
								<select  class="form-control" name="department_id">
									<?php foreach($grade_list as $grade){ 
										$grade_id = $grade->grade_id;
										?> 
										<option value="<?php echo $grade_id;?>" <?php if($grade_id ==  $form->grade ) echo 'selected'; ?> ><?php echo $grade->grade_name;?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Iqama / ID</label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" id=""iqama_id"" name="iqama_id" class="form-control" placeholder="9999999999" value="<?php echo $form->iqama_id;?>">
								<span class="help-block"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Iqama / ID Expiry</label>
						<div class="col-md-4 form-group">
							<input type="text" class="form-control form-control-inline date-picker"  data-date-format="dd-mm-yyyy" size="16" id="iqama_expiry" name="iqama_expiry" value='<?php echo Util::dateDisplayFormate( $form->iqama_expiry );?>' />
							<span class="help-block"></span>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Contact #</label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" id="mobile_no" name="mobile_no" class="form-control" placeholder="Enter Contact Number" value="<?php echo $form->mobile_no;?>">
								<span class="help-block"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Status</label>
						<div class="col-md-4">
							<div class="form-group">
								<div class="input-group">
									<div data-toggle="buttons" class="btn-group">
										<label class="btn blue <?php if($form->cdel == '0') echo 'active';?> ">
										<input type="radio" class="toggle" name="cdel" id="active_y" <?php if($form->cdel == '0') echo 'checked="checked"';?>  value="0"> Active
										</label>
										<label class="btn blue <?php if($form->cdel == '1') echo 'active';?>">
										<input type="radio" class="toggle" name="cdel" id="active_n" <?php if($form->cdel == '1') echo 'checked="checked"';?> value="1"> Inactive
										</label>
									</div>
								</div>
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
<script src="<?php echo base_url();?>assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script>
		jQuery(document).ready(function() {
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
</script>		    