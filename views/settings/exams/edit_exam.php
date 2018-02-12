<?php $form=$form[0]; //print_r($form)?>
<div class="col-md-12">
<!-- BEGIN CONDENSED TABLE PORTLET-->
<div class="portlet box blue">
		<!--<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('New Exam');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
			</div
		</div>>-->
		<div class="portlet-body">
			<div class="table-responsive">
				<form action="" method="post" id="mainForm">
					<input type="submit" id="sub_btn" value='0' onclick="return false;" style="display: none;"/>
				<table class="table table-condensed">
					<tbody>
						<tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Exam Name');?></td>
					       	<td><input type="text" class="form-control" id="exam_name" name="exam_name" value='<?php echo $form->exam_name;?>'  /></td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Exam Type');?></td>
				       		<td>
				       			<select name="exam_type" class="form-control" id="exam_type" >
				                    <option value="Marks" <?php echo ($form->exam_type == 'Marks') ? 'selected="selected"': '';?>><?php echo Base_Controller::ToggleLang('Marks'); ?></option>
				                    <option value="Grades" <?php echo ($form->exam_type == 'Grades') ? 'selected="selected"': '';?>><?php echo Base_Controller::ToggleLang('Grades'); ?></option>
				                    <option value="Marks and Grades" <?php echo ($form->exam_type == 'Marks and Grades') ? 'selected="selected"': '';?>><?php echo Base_Controller::ToggleLang('Marks and Grades'); ?></option>
				                </select></td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Exam Date');?></td>
				       		<td><input type="text" class="form-control form-control-inline date-picker"  data-date-format="dd-mm-yyyy" size="16" id="exam_date" name="exam_date" value='<?php echo Util::displayFormat($form->exam_date);?>'  /></td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Is Published');?></td>
				       		<td>
				       			<div class="form-group">
									<div class="input-group">
										<div data-toggle="buttons" class="btn-group">
											<label class="btn blue <?php echo ($form->is_published == 'Y') ? 'active': '';?>">
											<input type="radio" class="toggle" name="is_published" id="is_published_yes" value="Y" <?php echo ($form->is_published == 'Y') ? 'checked="checked"': '';?>> Yes
											</label>
											<label class="btn blue <?php echo ($form->is_published == 'N') ? 'active': '';?>">
											<input type="radio" class="toggle" name="is_published" id="is_published_no" <?php echo ($form->is_published == 'N') ? 'checked="checked"': '';?> value="N"> No
											</label>
										</div>
									</div>
								</div>
				       		</td>
				       </tr>	
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Result Published');?></td>
				       		<td>
				       			<div class="form-group">
									<div class="input-group">
										<div data-toggle="buttons" class="btn-group">
											<label class="btn blue <?php echo ($form->result_published == 'Y') ? 'active': '';?>">
											<input type="radio" class="toggle" name="result_published" id="result_published_yes" value="Y" <?php echo ($form->result_published == 'Y') ? 'checked="checked"': '';?>> Yes
											</label>
											<label class="btn blue <?php echo ($form->result_published == 'N') ? 'active': '';?>">
											<input type="radio" class="toggle" name="result_published" id="result_published_no" value="N" <?php echo ($form->result_published == 'N') ? 'checked="checked"': '';?>> No
											</label>
										</div>
									</div>
								</div>
			       				<input type="hidden" class="form-control" id="course_id" name="course_id" value='<?php echo $form->course_id;?>' />
			       				<input type="hidden" class="form-control" id="batch_id" name="batch_id" value='<?php echo $form->batch_id;?>' />
			       				<input type="hidden" class="form-control" id="id" name="id" value='<?php echo $form->id;?>' />
				       		</td>
				       		
				       </tr>
					</tbody>
				</table>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<script>
		jQuery(document).ready(function() {
			//App.init();
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
