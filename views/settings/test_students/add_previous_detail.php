<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><i class="fa fa-reorder"></i><?php echo Base_Controller::ToggleLang('Previous Details');?></div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php echo form_open('students/add_previous_detail',array('id'=>'previousDetailForm', 'class'=>"form-horizontal")); $today    = date('Y-m-d'); ?>
			<input type="hidden" id="student_id" name="student_id" value='<?php echo $_GET['student_id'];?>'  />
			<div class="form-body">
				<!--<h3 class="form-section"><?php echo Base_Controller::ToggleLang('Previous Details');?></h3>-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Institute');?>:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="institute" name="institute" value='' placeholder="<?php echo Base_Controller::ToggleLang('Institute');?>" />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Year');?>:</label>
							<div class="col-md-9">
								<select class="form-control" name="year" id="year" >
										<?php for($y=2014; $y>=1998; $y--){
											?> 
											<option value="<?php echo $y;?>" ><?php echo $y;?></option>
										<?php } ?>
								</select></td>
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Course');?>:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="course" id="course" value='' placeholder="<?php echo Base_Controller::ToggleLang('Course');?>" />
								<!-- <span class="help-block">This is inline help</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Total Marks');?>:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="total_marks" id="total_marks" value='' placeholder="<?php echo Base_Controller::ToggleLang('Total Marks');?>" />
								<!-- <span class="help-block">This field has error.</span> -->
							</div>
						</div>
					</div>
					<!--/span-->
				</div>
				<!--/row-->
				<?php if($not_popup){?>
				<div class="form-actions fluid">
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-offset-3 col-md-9">
								<button type="button" class="btn green" onclick="submitForm()" ><i class="fa fa-check"></i> <?php echo Base_Controller::ToggleLang('Submit');?></button>
								<button type="button" class="btn default" onclick="window.open('<?php echo base_url().$model;?>', '_self')" ><?php echo Base_Controller::ToggleLang('Cancel');?></button>                              
							</div>
						</div>
						<div class="col-md-6"></div>
					</div>
				</div>
			<?php } echo form_close();?>
			<!-- END FORM-->                
		</div>
	</div>
</div>	