<link type="text/css" href="<?php echo base_url();?>assets/css/redmond/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui-1.9.2.custom.min.js"></script>				
				<form id="collectFeeForm" method="post" >
					<div class="form-body">
						<div class="row alert alert-success">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">&nbsp;</label>
										<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Course Name');?></label>
										<div class="col-md-6">
											<select name="course_id" class="form-control" id="course_id" onchange="onchange_courses(this.value)">
	    					                    <option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
	    					                    <?php foreach($courses_list as $course){ 
	    					                    	$course_id = $course->course_id;
	    					                    	?> 
	    					                    	<option value="<?php echo $course_id;?>" <?php //if($course_id ==  $form->course_id) echo 'selected'; ?> ><?php echo $course->course_name;?></option>
	    					                    <?php } ?>
	    									</select>
										</div>
									</div>
								</div>
								<div class="col-md-6">&nbsp;</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">&nbsp;</label>
										<label class="control-label col-md-3 right"><?php echo Base_Controller::ToggleLang('Batch');?></label>
										<div class="col-md-6" id="td_batch">
											<select name="batch_id" class="form-control" id="batch_id" >
						                    	<option value="">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
											</select>
										</div>
										
									</div>
								</div>
								<div class="col-md-6">&nbsp;</div>
							</div>
						</div>
						
						<div class="row alert alert-info" id="td_student_idcards">
					 		<?php echo Base_Controller::ToggleLang('Please select course and batch'); ?>!!
					 	</div>
				 	</div>
					</form>
	        <input type="hidden" id="count" value="0"/>
	        <div id="dialog-form"></div>
<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/scripts/table-advanced.js"></script>
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>

<script> 
		jQuery(document).ready(function() {    
		   // initiate layout and plugins
		   App.init();
		   TableAdvanced.init();
		});

		function onchange_courses(val){
	        if(val != ''){
		        
        		get('<?php echo base_url().$model.'/batches/';?>'+val, '', 'td_batch','false','');
	        }
        }

        function onchange_batch(val){
        	
	        if(val != ''){
        		get('<?php echo base_url().$model.'/student_list/';?>'+val, '', 'td_student_idcards','false','');
	        }
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
            	        	get(_url+'?f=insert', '', 'divStudent', false, 'mainForm');
            	            $( this ).dialog( "close" );
            	          	},
            	        	Cancel: function() {
            	            $( this ).dialog( "close" );
            	          	}
            	        }, title: options.title, width:600, height: 400, draggable: true }).dialog('open');
            	      }
            	      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
            	      
            	    }
            	});
            }
            </script>