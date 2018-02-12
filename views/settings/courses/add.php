<div class="col-md-12">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('New Course');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<!-- BEGIN FORM name="name" data-required="1" class="form-control"-->
			<?php 
			echo form_open('courses/add',array('id'=>'mainForm', 'class'=>"form-horizontal"));
			$name = array('name' => 'course_name', 'id'   => 'course_name', 'class' => 'form-control', 'value' => '');
			$section_name = array('name' => 'section_name', 'id'   => 'section_name', 'class' => 'form-control', 'value' => '');
			$fee_per_year = array('name' => 'FEE_PER_YEAR_DIS', 'id'   => 'FEE_PER_YEAR_DIS', 'class' => 'form-control', 'value' => '');
			$TRANSPORT_FEE = array('name' => 'TRANSPORT_FEE_DIS', 'id'   => 'TRANSPORT_FEE_DIS', 'class' => 'form-control', 'value' => '');
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
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Course Name');?><span class="required">*</span></label>
						<div class="col-md-4">
							<div class="form-group">
								<?php echo form_input($name);?>
								<span class="help-block"><?php echo form_error('course_name');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Section');?></label>
						<div class="col-md-4">
							<div class="form-group">
								<?php echo form_input($section_name);?>
								<span class="help-block"><?php echo form_error('section_name');?></span>
							</div>
						</div>
					</div>
					<?php if(ENABLE_FEE_MODULE == 1){?>
					<!-- Search Fields for each department START -->
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Tuition Fee');?></label>
						<div class="col-md-4">
							<div class="form-group">
								<?php echo form_input($fee_per_year);?>
								<span class="help-block"><?php echo form_error('fee_per_year');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Transportation Fee');?></label>
						<div class="col-md-4">
							<div class="form-group">
								<?php echo form_input($TRANSPORT_FEE);?>
								<span class="help-block"><?php echo form_error('TRANSPORT_FEE_DIS');?></span>
							</div>
						</div>
					</div>	
					<?php } ?>
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