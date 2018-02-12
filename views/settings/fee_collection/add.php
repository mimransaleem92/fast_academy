<div class="col-md-12">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Fee Collection');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<!-- BEGIN FORM name="name" data-required="1" class="form-control"-->
			<?php 
			echo form_open('fee_collection/add',array('id'=>'mainForm', 'class'=>"form-horizontal"));
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
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Fee Category');?><span class="required">*</span></label>
						<div class="col-md-4">
							<div class="form-group">
								<select name="fee_category_id" class="form-control" id="fee_category_id" onchange="onchange_fee_category(this.value)">
				                    <option value="" selected>---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
				                    <?php foreach($fee_category_list as $category){ 
				                    	$category_id = $category->id;
				                    	?> 
				                    	<option value="<?php echo $category_id;?>" ><?php echo $category->category_name. '-' . $category->batch_name;?></option>
				                    <?php } ?>
								</select><span class="help-block"><?php //echo form_error('category_name');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Collection Name');?><span class="required">*</span></label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="<?php echo Base_Controller::ToggleLang('Collection Name');?>" name="collection_name" id="collection_name" value='<?php if(isset($_REQUEST['collection_name'])) echo $_REQUEST['collection_name'];?>' />
								<span class="help-block"><?php echo form_error('collection_name');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Start Date');?></label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="16" placeholder="dd-mm-yyyy" name="start_date" id="start_date" value='<?php if(isset($_REQUEST['start_date'])) echo $_REQUEST['start_date'];?>' />
								<span class="help-block"><?php echo form_error('start_date');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('End Date');?></label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="16" placeholder="dd-mm-yyyy" name="end_date" id="end_date" value='<?php if(isset($_REQUEST['end_date'])) echo $_REQUEST['end_date'];?>' />
								<span class="help-block"><?php echo form_error('end_date');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Due Date');?></label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" class="form-control form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="16" placeholder="dd-mm-yyyy" name="due_date" id="due_date" value='<?php if(isset($_REQUEST['due_date'])) echo $_REQUEST['due_date'];?>' />
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
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/scripts/form-validation.js"></script> 
<script>
		jQuery(document).ready(function() {
			App.init();	
		});
		FormValidation.init();
		if (jQuery().datepicker) {
           $('.date-picker').datepicker({
           	dateFormat: "dd-mm-yy",
               rtl: App.isRTL(),
               autoclose: true
           });
           $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
       }

	    function onchange_fee_category(val){
	        if(val != ''){
        		
	        }
        }
	        
</script>    