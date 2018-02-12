<div class="col-md-12">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('New Batch');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<!-- BEGIN FORM name="name" data-required="1" class="form-control"-->
			<?php 
			$form = $form[0];
			echo form_open('batches/update',array('id'=>'mainForm', 'class'=>"form-horizontal"));
				echo form_hidden("batch_id",$form->batch_id);
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
								<select name="course_id" class="form-control select2me" id="course_id" >
				                    <option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
				                    <?php foreach($courses_list as $course){ 
				                    	$course_id = $course->course_id;
				                    	?> 
				                    	<option value="<?php echo $course_id;?>" <?php if( isset($form->course_id) && $course_id == $form->course_id) echo 'selected';?> ><?php echo $course->course_name;?></option>
				                    <?php } ?>
								</select>
								<span class="help-block"><?php echo form_error('course_id');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Batch Name');?><span class="required">*</span></label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="<?php echo Base_Controller::ToggleLang('Batch Name');?>" name="batch_name" id="batch_name" value='<?php if(isset($form->batch_name)) echo $form->batch_name;?>' />
								<span class="help-block"><?php echo form_error('batch_name');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Start Date');?></label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="16" placeholder="dd-mm-yyyy" name="start_date" id="start_date" value='<?php if(isset($form->start_date)) echo $form->start_date;?>' />
								<span class="help-block"><?php echo form_error('start_date');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('End Date');?></label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="16" placeholder="dd-mm-yyyy" name="end_date" id="end_date" value='<?php if(isset($form->end_date)) echo $form->end_date;?>' />
								<span class="help-block"><?php echo form_error('end_date');?></span>
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
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js" type="text/javascript" ></script>


	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>

<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/scripts/form-validation.js"></script>  
<script>
		jQuery(document).ready(function() {
			App.init();
			FormValidation.init();
			if (jQuery().datepicker) {
		           $('.date-picker').datepicker({
		           	dateFormat: "dd-mm-yy",
		               rtl: App.isRTL(),
		               autoclose: true
		           });
		           $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
		       }
		});


        function onchange_courses(val){
	    	get('<?php echo base_url().'batches/courses/';?>'+val, '', 'td_batch','false','');
	    }
	        
</script>    

	           