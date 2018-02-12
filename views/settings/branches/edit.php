<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/jquery-multi-select/css/multi-select.css" />

<div class="col-md-12">
	<!-- BEGIN FORM-->
	<?php  
		    $form = $form[0];
		    echo form_open('division/update',array('id'=>'mainForm', 'class'=>"form-horizontal"));
		    echo form_hidden("division_id",$form->division_id);
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
				<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Company');?><span class="required">*</span></label>
				<div class="col-md-4">
					<div class="form-group">
						<select name="company_id" class="form-control" id="company_id" >
		                    <option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
		                    <?php foreach($company_list as $comp){ 
		                    	$comp_id = $comp->company_id;
		                    	?> 
		                    	<option value="<?php echo $comp_id;?>" <?php if($comp_id ==  $form->company_id) echo 'selected'; ?> ><?php echo $comp->name;?></option>
		                    <?php } ?>
						</select><span class="help-block"></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label">Name<span class="required">*</span></label>
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" name="name" data-required="1" class="form-control" placeholder="Enter Name" value="<?php echo $form->name;?>">
						<span class="help-block"></span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label  class="col-md-3 control-label">Arabic Name</label>
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" name="arabic_name" class="form-control" placeholder="Enter Arabic Name" value="<?php echo $form->arabic_name;?>">
						<span class="help-block"></span>
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
              
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js" type="text/javascript" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>

<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/form-validation.js"></script> 
<script>
		jQuery(document).ready(function() { 
			App.init();		
			$('#availableScreens').multiSelect();
			FormValidation.init();
			
			var initialized = false;
			var input = $("#password_strength");

			input.keydown(function () {
				if (initialized === false) {
					// set base options
					input.pwstrength({
						raisePower: 1.4,
						minChar: 8,
						verdicts: ["Weak", "Normal", "Medium", "Strong", "Very Strong"],
						scores: [17, 26, 40, 50, 60]
					});

					// add your own rule to calculate the password strength
					input.pwstrength("addRule", "demoRule", function (options, word, score) {
						return word.match(/[a-z].[0-9]/) && score;
					}, 10, true);

					// set as initialized 
					initialized = true;
				}
			});
			
		});

        function onchange_company(val){
        	get('<?php echo base_url().'division/branches/';?>'+val, '', 'td_branch','false','');
        }  
</script>