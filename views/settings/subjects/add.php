<div class="col-md-12">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('New Subject');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<!-- BEGIN FORM name="name" data-required="1" class="form-control"-->
			<?php 
			echo form_open('subjects/add',array('id'=>'mainForm', 'class'=>"form-horizontal"));
			$name     = array('name' => 'subject_name', 'id'   => 'subject_name', 'class' => 'form-control', 'value' => '');
			$arabic_name     = array('name' => 'subject_name_arabic', 'id'   => 'subject_name_arabic', 'class' => 'form-control', 'value' => '',  'style'=>"text-align: right");
			$total_marks = array('name' => 'total_marks', 'id'   => 'total_marks', 'class' => 'form-control', 'value' => '');
			$code     = array('name' => 'subject_code', 'id'   => 'subject_code', 'class' => 'form-control', 'value' => '');
			?>
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
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Subjects Name');?><span class="required">*</span></label>
						<div class="col-md-4">
							<div class="form-group">
								<?php echo form_input($name);?>
								<span class="help-block"><?php echo form_error('subject_name');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Arabic Name');?><span class="required">*</span></label>
						<div class="col-md-4">
							<div class="form-group">
								<?php echo form_input($arabic_name);?>
								<span class="help-block"><?php echo form_error('subject_name_arabic');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Code');?></label>
						<div class="col-md-4">
							<div class="form-group">
								<?php echo form_input($code);?>
								<span class="help-block"><?php echo form_error('subject_code');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Monthly Test Marks');?></label>
						<div class="col-md-4">
							<div class="form-group">
								<?php echo form_input($total_marks);?>
								<span class="help-block"><?php echo form_error('total_marks');?></span>
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
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/scripts/form-validation.js"></script> 
<script>
		jQuery(document).ready(function() {
			App.init();	
		});
</script>