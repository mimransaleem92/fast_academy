<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/jquery-multi-select/css/multi-select-rtl.css" />

<div class="col-md-12">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('New Department');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<!-- BEGIN FORM-->
			<?php echo form_open('department/add',array('id'=>'mainForm', 'class'=>"form-horizontal")); ?>
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
								<input type="text" name="name" data-required="1" class="form-control" placeholder="Enter Name" value="<?php echo set_value('name');?>" >
								<span class="help-block"><?php echo form_error('name');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Arabic Name</label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="arabic_name" class="form-control" placeholder="Enter Arabic Name">
								<span class="help-block"></span>
							</div>
						</div>
					</div>
					<!-- Search Fields for each department START -->
					<div class="form-group">
						<label  class="col-md-3 control-label">Search Field Name 1:</label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="search_field1" data-required="1" class="form-control" placeholder="Enter Field Name" value="<?php echo set_value('search_field1');?>" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Search Field Name 2:</label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="search_field2" data-required="1" class="form-control" placeholder="Enter Field Name" value="<?php echo set_value('search_field2');?>" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Search Field Name 3:</label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="search_field3" data-required="1" class="form-control" placeholder="Enter Field Name" value="<?php echo set_value('search_field3');?>" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Search Field Name 4:</label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="search_field4" data-required="1" class="form-control" placeholder="Enter Field Name" value="<?php echo set_value('search_field4');?>" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label">Search Field Name 5:</label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="search_field5" data-required="1" class="form-control" placeholder="Enter Field Name" value="<?php echo set_value('search_field5');?>" >
							</div>
						</div>
					</div>
					<!-- Search Fields for each department END -->
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
	
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/scripts/form-validation.js"></script> 
<script>
		jQuery(document).ready(function() {
			App.init();	
		});
</script>