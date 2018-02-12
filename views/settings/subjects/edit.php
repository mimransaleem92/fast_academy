<link type="text/css" href="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js"></script>
<style>
<!--
.noclose .ui-dialog-titlebar-close
{
    display:none;
}
-->
</style>
<div class="col-md-12">
	<div class="col-md-6">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Update Subject');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<!-- BEGIN FORM name="name" data-required="1" class="form-control"-->
			<?php 
			$form = $form[0];
			echo form_open('subjects/update',array('id'=>'mainForm', 'class'=>"form-horizontal"));
			?>
			<input type="hidden" name="subject_id" id="subject_id" value="<?php echo $form->subject_id;?>">
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
						<label  class="col-md-4 control-label"><?php echo Base_Controller::ToggleLang('Subject Name');?><span class="required">*</span></label>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="<?php echo Base_Controller::ToggleLang('Subject Name');?>" name="subject_name" id="subject_name" value='<?php if(isset($form->subject_name)) echo $form->subject_name;?>' />
								<span class="help-block"><?php echo form_error('subject_name');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-4 control-label"><?php echo Base_Controller::ToggleLang('Arabic Name');?><span class="required">*</span></label>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="<?php echo Base_Controller::ToggleLang('Arabic Name');?>" name="subject_name_arabic" id="subject_name_arabic" value='<?php if(isset($form->subject_name_arabic)) echo $form->subject_name_arabic;?>' style="text-align: right;"/>
								<span class="help-block"><?php echo form_error('subject_name_arabic');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-4 control-label"><?php echo Base_Controller::ToggleLang('Short Name');?></label>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="<?php echo Base_Controller::ToggleLang('SHORT NAME');?>" name="subject_code" id="subject_code" value='<?php if(isset($form->subject_code)) echo $form->subject_code;?>' />
								<span class="help-block"><?php echo form_error('subject_code');?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo Base_Controller::ToggleLang('Monthly Test Marks');?></label>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="<?php echo Base_Controller::ToggleLang('Monthly Test Marks');?>" name="total_marks" id="total_marks" value='<?php if(isset($form->total_marks)) echo $form->total_marks;?>' />
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
	<div class="col-md-6">
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Add / Remove Instructor or Teacher');?></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<table>
				<tr>
					<td>
						<select name="employee_id" class="form-control select2me" id="employee_id" style="width: 220px">
		                    <option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
		                    <?php foreach($employee_list as $emp){ 
		                    		$employee_id = $emp->employee_id;
		                    	?> 
		                    	<option value="<?php echo $employee_id;?>" ><?php echo $emp->employee_name;?></option>
		                    <?php } ?>
						</select></td>
					<td>
						<button type="button" class="btn default" onclick="onclick_add_employee();" >Add</button>
					</td>
				</tr>
			</table>
			<div class="table-responsive scroller" id="divEmployee" style="height: 273px; overflow: scroll">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th></th>
							<th><?php echo Base_Controller::ToggleLang('ID');?></th>
							<th><?php echo Base_Controller::ToggleLang('Employee Name');?></th>
						</tr>
					</thead>
					<tbody>					
						<?php $i=0;
						if(isset($associated_employee_list) && sizeof($associated_employee_list) > 0){                          	
                          	foreach($associated_employee_list as $values){ $i++; ?>
	                          <tr>
	                            <td><a class="btn default btn-xs red-stripe" href="#" onclick="onclick_remove_employee('<?php echo $values->employee_id;?>')">Remove</a></td>
	                            <td><strong><?php echo $values->employee_id; ?></strong></td>
	                            <td><?php echo $values->employee_name?></td>
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

	<div class="clearfix"></div>
	<div class="col-md-12">
		<?php $course_list = array('KG1', 'KG2', 'KG3', 'GRADE1', 'GRADE2', 'GRADE3', 'GRADE4', 'GRADE5', 'GRADE6', 'GRADE7', 'GRADE8', 'GRADE9', 'GRADE10', 'GRADE11', 'GRADE12');?>
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Subject Detail');?></div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body" id="tbl_subdetail">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th></th>
							<th><?php echo Base_Controller::ToggleLang('ID');?></th>
							<th><?php echo Base_Controller::ToggleLang('Course');?></th>
							<th><?php echo Base_Controller::ToggleLang('Report Title');?></th>
							<th><?php echo Base_Controller::ToggleLang('Marks');?></th>
							<th title='<?php echo Base_Controller::ToggleLang('Period per Week');?>' >P/W</th>
							<th title='<?php echo Base_Controller::ToggleLang('Credit Hours');?>' > C.H</th>
						</tr>
					</thead>
					<tbody>					
						<?php $i=0;
                          if(isset($headers_list) && sizeof($headers_list) > 0){                          	
                          	foreach($headers_list as $values){ $i++; 
	                          	$title = "Update Header info";
	                          	$param = "course_id=".$values->course_id."&sid=".$values->subject_id;
	                          	if(isset($form->subject_name)) $param .= "&subject_name=". $form->subject_name;
	                          	$url   = base_url().$model."/edit_header";
                          	?>
	                          <tr>
	                            <!--  <td><a class="btn default btn-xs red-stripe" href="#" onclick="onclick_remove_course_subject('<?php echo $values->course_id."', '".$values->subject_id;?>')">Remove</a></td>-->
	                            <td>
	                            	<span <?php echo 'onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \'tbl_subdetail\')"';?> href="#" class="btn btn-xs blue" ><i class="fa fa-edit"></i></span>
	                            </td>
	                            <td><?php echo $values->course_id?></td>
	                            <td><strong><?php echo $values->course_name; ?></strong></td>
	                            <td><?php echo $values->marksheet_title?></td>
	                            <td><?php echo $values->marksheet_score?></td>
	                            <td><?php echo $values->period_per_week;?></td>
	                            <td><?php echo $values->credit_hours;?></td>
	                          </tr>
	                  <?php 	}
                          }
                          	?>
	                </tbody>
				</table>
				Mark sheet header info
			</div>
		</div>		
	</div>
</div>
<div id="dialog-form"></div>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>

<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>  
<script>
		jQuery(document).ready(function() {
			App.init();
			
			if (jQuery().datepicker) {
		           $('.date-picker').datepicker({
		           	dateFormat: "dd-mm-yy",
		               rtl: App.isRTL(),
		               autoclose: true
		           });
		           $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
		       }
		});

		function onclick_add_employee(){
			var subject_id = document.getElementById('subject_id').value;
			var employee_id = document.getElementById('employee_id').value;
			var param = 'employee_id='+employee_id+'&subject_id='+subject_id;
			if(subject_id == '') { 
				alert("Please select employee"); 
				}
			else {
				
				get('<?php echo base_url().'subjects/add_employee';?>', param, 'divEmployee','false','');
			}
		} 

		function onclick_remove_employee(employee_id){
			var subject_id = document.getElementById('subject_id').value;
			var param = 'employee_id='+employee_id+'&subject_id='+subject_id;
			
			get('<?php echo base_url().'subjects/remove_employee';?>', param, 'divEmployee','false','');
			
		}

		function showUrlInDialog(_url, params, options, cell_id){
        	options = options || {};
        	var tag = $("#dialog-form"); //This tag will hold the dialog content.
        	$.ajax({
        	    url: _url+'?'+params,
        	    type: (options.type || 'POST'),
        	    beforeSend: options.beforeSend,
        	    error: options.error,
        	    complete: options.complete,
        	    success: function(data, textStatus, jqXHR) {
        	      if(typeof data == "object" && data.html) { //response is assumed to be JSON
        	        tag.html(data.html).dialog({modal: options.modal, title: data.title, width:700, height: 500, draggable: true}).dialog('open');
        	      } else { //response is assumed to be HTML
        	        tag.html(data).dialog({modal: options.modal,  
            	        buttons: {
        	        	Save: function() {
        	        	get(_url+'_update', '', cell_id, false, 'marksForm');
        	            $( this ).dialog( "close" );
        	          	},
        	        	Cancel: function() {
        	            $( this ).dialog( "close" );
        	          	}
        	        }, title: options.title, width:640, height: 450, draggable: true }).dialog('open');
        	      }
        	      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
        	      
        	    }
        	});
        }	  
</script>