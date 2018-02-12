<link type="text/css" href="<?php echo base_url();?>assets/css/redmond/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui-1.9.2.custom.min.js"></script>				
				<form id="topSelectionForm" method="post" >
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
							<div class="row">
								<div class="col-md-6" id="div_tree">&nbsp;</div>
							</div>
							<!-- <div  style="padding: 4px 4px 4px 16px;"></div>  -->
						</div>
						
						<div class="row alert alert-info" >
							<div id="div_exams"><?php echo Base_Controller::ToggleLang('Please select course and batch'); ?>!!</div>
					 	</div>
				 	</div>
					</form>
	        <input type="hidden" id="count" value="0"/>
	        <div id="dialog-form"></div>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/scripts/table-advanced.js"></script>
<script> 
		jQuery(document).ready(function() {    
		   // initiate layout and plugins
		   App.init();
		   TableAdvanced.init();
		});

		var tree_elements = [];
		function onchange_courses(val){
	        if(val != '0'){
	        	document.getElementById('div_exams').innerHTML = "Now Please Select batch";
        		get('<?php echo base_url().$model.'/batches/';?>'+val, '', 'td_batch','false','');
	        }
	        else{
	        	document.getElementById('div_exams').innerHTML = "Please Select course then batch";
	        }   
        }

        function onchange_batch(val){
        	if(val != '0'){
            	var param = 'course_id='+ document.getElementById('course_id').value + '&batch_id=' + val;
        		get('<?php echo base_url().$model.'/add/';?>'+val, param, 'div_exams','false','');
	        }
	        else{
	        	document.getElementById('div_exams').innerHTML = "Please Select batch";
	        }
        	document.getElementById('div_tree').innerHTML = '';
        }

        function manage_exams(val){
			if(document.getElementById('exam_name'+val)){
        		tree_elements[0] = document.getElementById('exam_name'+val).innerHTML ;
			}
			if(val != '0'){
            	var param = 'course_id='+ document.getElementById('course_id').value + '&batch_id=' + document.getElementById('batch_id').value;
        		get('<?php echo base_url().$model.'/schedule_subjects/';?>'+val, param, 'div_exams','false','');
	        }
	        else{
	        	document.getElementById('div_exams').innerHTML = "Invalid Exam ID!!";
	        }
			document.getElementById('div_tree').innerHTML = tree_elements[0];
		}

		function exam_score_subject(val, exam_id){
			if(document.getElementById('sub_name'+val)) { 
				tree_elements[1] = document.getElementById('sub_name'+val).innerHTML ;
			}
			if(val != '0'){
            	var param = 'course_id='+ document.getElementById('course_id').value + '&batch_id=' + document.getElementById('batch_id').value+'&exam_id='+exam_id;
        		get('<?php echo base_url().$model.'/exam_score_subject/';?>'+val, param, 'div_exams','false','');
	        }
	        else{
	        	document.getElementById('div_exams').innerHTML = "Invalid Exam ID!!";
	        }
			document.getElementById('div_tree').innerHTML = tree_elements[0]+ ' > ' + tree_elements[1];
		}

		function submit_scores(){
			if(confirm('Are you sure? you want to submit the scores.')){
				var param = 'course_id='+ document.getElementById('course_id').value + '&batch_id=' + document.getElementById('batch_id').value;
				get('<?php echo base_url().$model.'/add_scores/';?>', param, 'div_exams','false','topSelectionForm');
			}
		}

		function clear_all_scores(val, exam_id){
			if(confirm('Are you sure? you want to clear the scores.')){
				var param = 'course_id='+ document.getElementById('course_id').value + '&batch_id=' + document.getElementById('batch_id').value+'&exam_id='+exam_id;
				get('<?php echo base_url().$model.'/del_scores/';?>'+val, param, 'div_exams','false','');
			}
		}
		
        function del_exams(val){
			if(confirm('Are you sure? you want to delete selected exam.')){
				var param = 'course_id='+ document.getElementById('course_id').value + '&batch_id=' + document.getElementById('batch_id').value;
				get('<?php echo base_url().$model.'/del_exams/';?>'+val, param, 'div_exams','false','');
			}
		}
		
		function del_schedule(val, exam_id){
			if(confirm('Are you sure? you want to delete selected schedule.')){
				var param = 'course_id='+ document.getElementById('course_id').value + '&batch_id=' + document.getElementById('batch_id').value+'&exam_id='+exam_id;
				get('<?php echo base_url().$model.'/del_schedule/';?>'+val, param, 'div_exams','false','');
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
            	        	get(_url+'?f=insert', '', 'div_exams', false, 'mainForm');
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