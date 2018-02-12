<div class="col-md-12">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Update Course');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<!-- BEGIN FORM name="name" data-required="1" class="form-control"-->
			<?php 
			$form = $form[0];
			echo form_open('courses/update',array('id'=>'mainForm', 'class'=>"form-horizontal"));
			//	echo form_hidden("course_id",$form->course_id);
			?>
			<input type="hidden" name="course_id" id="course_id" value="<?php echo $form->course_id;?>">
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
								<input type="text" class="form-control" placeholder="<?php echo Base_Controller::ToggleLang('Course Name');?>" name="course_name" id="course_name" value='<?php if(isset($form->course_name)) echo $form->course_name;?>' />
								<span class="help-block"><?php echo form_error('course_name');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Section');?></label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="<?php echo Base_Controller::ToggleLang('Section');?>" name="section_name" id="section_name" value='<?php if(isset($form->section_name)) echo $form->section_name;?>' />
								<span class="help-block"><?php echo form_error('batch_name');?></span>
							</div>
						</div>
					</div>
					<?php if(ENABLE_FEE_MODULE == 1){?>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Tuition Fee');?></label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="<?php echo Base_Controller::ToggleLang('Annual Fee');?>" name="FEE_PER_YEAR_DIS" id="FEE_PER_YEAR_DIS" value='<?php if(isset($form->FEE_PER_YEAR_DIS)) echo $form->FEE_PER_YEAR_DIS;?>' />
								<span class="help-block"><?php echo form_error('FEE_PER_YEAR_DIS');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Transportation Fee');?></label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="<?php echo Base_Controller::ToggleLang('Transportation Fee');?>" name="TRANSPORT_FEE_DIS" id="TRANSPORT_FEE_DIS" value='<?php if(isset($form->TRANSPORT_FEE_DIS)) echo $form->TRANSPORT_FEE_DIS;?>' />
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
	
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Add / Remove Subjects');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div>
		</div>
		<div class="portlet-body">
			<form action="" id="course_subject">
			<input type="hidden" id="course_id" name="course_id" value="<?php echo $form->course_id;?>">
			<table>
				<tr>
					<td>
						<select name="subject_id" class="form-control select2me" id="subject_id" style="width: 220px">
		                    <option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
		                    <?php foreach($subject_list as $sub){ 
                    				$subject_id = $sub->subject_id;
		                    	?> 
		                    	<option value="<?php echo $subject_id;?>" ><?php echo $sub->subject_code. ' ' .$sub->subject_name;?></option>
		                    <?php } ?>
						</select></td>
					<td>
						<input type="text" class="form-control " style="width: 75px" name="period_per_week" id="period_per_week" value="" placeholder="Period" />
					</td>
					<td>
						<input type="text" class="form-control " style="width: 75px" name="credit_hours" id="credit_hours" value="" placeholder="credit hours" />
					</td>	
					<td>
						<button type="button" class="btn default" onclick="onclick_add_subject();" >Add</button>
					</td>
				</tr>
			</table></form>
			<div class="table-responsive" id="divSubject">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th></th>
							<th><?php echo Base_Controller::ToggleLang('ID');?></th>
							<th><?php echo Base_Controller::ToggleLang('Short Name');?></th>
							<th><?php echo Base_Controller::ToggleLang('Subject Name');?></th>
							<th><?php echo Base_Controller::ToggleLang('Period per week');?></th>
							<th><?php echo Base_Controller::ToggleLang('Credit hours');?></th>
						</tr>
					</thead>
					<tbody>					
						<?php $i=0;
                          if(isset($assigned_subject_list) && sizeof($assigned_subject_list) > 0){                          	
                          	foreach($assigned_subject_list as $values){ $i++; ?>
	                          <tr>
	                            <td><a class="btn default btn-xs red-stripe" href="#" onclick="onclick_remove_subject('<?php echo $values->subject_id;?>')">Remove</a></td>
	                            <td><?php echo $values->subject_id?></td>
	                            <td><strong><?php echo $values->subject_code; ?></strong></td>
	                            <td><?php echo $values->subject_name?></td>
	                            <td><?php echo $values->period_per_week;?></td>
	                            <td><?php echo $values->credit_hours;?></td>
	                          </tr>
	                  <?php 	}
                          }
                          	?>
	                </tbody>
				</table>
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

        function onclick_add_subject(){
        	var subject_id = document.getElementById('course_subject').subject_id.value;
        	if(subject_id == '0') { 
        		alert("Please select subject"); 
        	}
        	else {
        		
        		get('<?php echo base_url().'courses/add_subject';?>', '', 'divSubject','false','course_subject');
        	}
        } 

        function onclick_remove_subject(subject_id){
        	var course_id = document.getElementById('course_id').value;
        	var param = 'course_id='+course_id+'&subject_id='+subject_id;
        	
        	get('<?php echo base_url().'courses/remove_subject';?>', param, 'divSubject','false','');
        	
        } 
	        
</script>