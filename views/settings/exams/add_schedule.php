<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css" />
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
				       		<td><?php echo Base_Controller::ToggleLang('Subject');?></td>
					       	<td>
					       		<select name="subject_id" class="form-control select2me" id="subject_id" >
				                    <option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
				                    <?php foreach($course_subject as $sub){ 
		                    				$subject_id = $sub->subject_id;
				                    	?> 
				                    	<option value="<?php echo $subject_id;?>" ><?php echo $sub->subject_name;?></option>
				                    <?php } ?>
								</select>
					       	</td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Start Time');?></td>
				       		<td>
				       			<div class="input-group date form_meridian_datetime" data-date="">                                       
									<input type="text" size="16" readonly class="form-control" id="start_time" name="start_time">
									<span class="input-group-btn">
									<button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
									</span>
									<span class="input-group-btn">
									<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
				       		</td>
				       </tr>
				       <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('End Time');?></td>
				       		<td><!-- <input type="text" class="form-control form-control-inline date-picker"  data-date-format="dd-mm-yyyy" size="16" id="exam_date" name="exam_date" value=''  /> -->
				       			<div class="input-group date form_meridian_datetime" data-date="">                                       
									<input type="text" size="16" readonly class="form-control" id="end_time" name="end_time">
									<span class="input-group-btn">
									<button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
									</span>
									<span class="input-group-btn">
									<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
				       		</td>
				       </tr>
				        <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Max Marks');?></td>
				       		<td><input type="text" class="form-control" id="max_marks" name="max_marks" value=''  /></td>
				       </tr>
				        <tr> 
				       		<td><?php echo Base_Controller::ToggleLang('Min Marks');?></td>
				       		<td><input type="text" class="form-control" id="min_marks" name="min_marks" value=''  /></td>
				       </tr>
				       <tr> 
				       		<td></td>
				       		<td>
				       			<input type="hidden" class="form-control" id="exam_id" name="exam_id" value='<?php echo $_GET['exam_id'];?>' />
				       			<input type="hidden" class="form-control" id="course_id" name="course_id" value='<?php echo $_GET['course_id'];?>' />
			       				<input type="hidden" class="form-control" id="batch_id" name="batch_id" value='<?php echo $_GET['batch_id'];?>' /> 
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
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>

<script>
		jQuery(document).ready(function() {
			//App.init();
			if (jQuery().datepicker) {
		           $('.date-picker').datepicker({
		           	dateFormat: "dd-mm-yyyy",
		               rtl: App.isRTL(),
		               autoclose: true
		           });

		           $(".form_meridian_datetime").datetimepicker({
		               isRTL: App.isRTL(),
		               format: "yyyy-mm-dd hh:ii",
		               showMeridian: true,
		               autoclose: true,
		               pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
		               todayBtn: true
		           });
		           $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
		       }
		});
		</script>
