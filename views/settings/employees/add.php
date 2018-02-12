<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css"/>

<div class="col-md-12">
    <div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('New Employee');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<!-- BEGIN FORM-->
			<?php echo form_open('employee/add',array('id'=>'mainForm', 'class'=>"form-horizontal")); 
				//echo form_hidden("role_id", '2');?>
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
								<input type="text" name="employee_name" data-required="1" class="form-control" placeholder="Enter Name" value="<?php echo set_value('employee_name');?>" >
								<span class="help-block"><?php echo form_error('employee_name');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Father Name</label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" id="father_name" name="father_name" class="form-control" placeholder="Enter Father Name">
								<span class="help-block"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Designation</label>
						<div class="col-md-4">
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
					</div>
					
					<div class="form-group">
						<label  class="col-md-3 control-label">Iqama / ID</label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" id=""iqama_id"" name="iqama_id" class="form-control" placeholder="9999999999">
								<span class="help-block"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Iqama / ID Expiry</label>
						<div class="col-md-4">
							<input type="text" class="form-control form-control-inline date-picker"  data-date-format="dd-mm-yyyy" size="16" id="iqama_expiry" name="iqama_expiry" value='<?php echo date('d-m-Y');?>' />
							<span class="help-block"></span>
						
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Contact #</label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" id="mobile_no" name="mobile_no" class="form-control" placeholder="Enter Contact Number">
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