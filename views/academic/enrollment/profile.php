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
<h3>Candidate Info: <?php $form = $form[0]; echo $form->student_name; //echo $session_start; //$start = microtime(true); echo 'time_elapsed: '.$time_elapsed;?></h3>
<div class="tabbable tabbable-custom boxless">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tabs_0" data-toggle="tab">Candidate Detail</a></li>
		<li><a href="#tabs_1" data-toggle="tab">Documents & files</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabs_0">			
		<?php $today = date('Y-m-d'); 
			echo form_open('students/add',array('id'=>'mainForm'));
		?>
			<input type="hidden" id="after_ajax" value="N"/>
			<input type="hidden" id="enrollment_id" name="enrollment_id" value="<?php echo $form->enrollment_id?>"/>
			<input type="hidden" id="batch_id" name="batch_id" value="<?php echo $form->batch_id?>"/>
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption"><i class="fa fa-picture"></i><?php echo Base_Controller::ToggleLang('Profile');?></div>
					<div class="tools"></div>
				</div>
				<div class="portlet-body">
					<?php if(isset($_GET['e']) && $_GET['e'] == '1'){?>
					<div class="alert alert-danger">
						<button class="close" data-close="alert"></button>
						<div id="error1">Sorry! You are not authorized to collect student fee payments.</div>
					</div>
					<?php }?>
					<div class="panel-group accordion scrollable" id="accordion2">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_1">
									Student Information
									</a>
								</h4>
							</div>
							<div id="collapse_2_1" class="panel-collapse in">
								<div class="panel-body">
									<table class="table">
						                <tbody><tr >
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Admission No');?>:</td>
											<td width='20%'  ><?php echo $form->admission_number;?></td>
											<td width='15%'  ><?php echo Base_Controller::ToggleLang('Date of Admission');?>:</td>
											<td width='20%'  ><?php echo Util::dateDisplayFormate($form->admission_date);?></td>
											
											<!-- <td width='15%' ><?php echo Base_Controller::ToggleLang('City');?>:</td>
											<td width='20%'  ><?php echo $form->city;?></td> -->
											<td width='260' rowspan="8" valign="middle" align="center" >
												<?php 
												$file_name = $form->enrollment_id;
												$dir_path = 'assets/uploads/students/';
												$filetype_arr = array('.jpg', '.jpeg', '.png', '.gif');
												foreach($filetype_arr as $type){
													$filepath = $dir_path.$file_name.$type;
													if( file_exists($filepath)) {
														$file_name = $file_name.$type;
														break;
													}
													$filepath = '';
												}
												?>
												<ul class="list-unstyled">
													<li>
													<img class="img-responsive" alt="" style="height:270px; width:250px"  src="<?php echo base_url().$filepath;?>"> <br/>
													<a class="btn default btn-xs blue-stripe" href="<?php echo base_url().$model."/profilephoto/".$form->enrollment_id;?>" target="_self">Edit Photo</a>
													<?php if($admin_role >= 2){?>
													<a href="<?php echo base_url(). $model . "/edit/".$form->enrollment_id;?>" class="btn default btn-xs red-stripe"  >Update Student Info</a>
													<?php }?>
													</li>
												</ul>
												
											</td>
										</tr>
										<tr>
											<td width='15%'  ><?php echo Base_Controller::ToggleLang("Candidate Name");?>:</td>
											<td width='35%' colspan="2" ><?php echo ($form->student_name);?></td>
											
											<td width='20%' style='font-family: "DroidKufi Regular", Tahoma;' align="right"><?php  echo ($form->student_name_ar);?></td>
											
										</tr>
										
										<tr>
											<td width='15%'  ><?php echo Base_Controller::ToggleLang("Enrollment Grade Level");?>:</td>
											<td width='20%'  ><?php echo ($form->enrollment_grade_level);?></td>
											
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Previous School');?>:</td>
											<td width='20%'  ><?php echo ($form->previous_school)?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Present Grade');?>:</td>
											<td width='20%'  ><?php echo $form->course_name . ' ' . $form->section;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Academic Year');?>:</td>
											<td width='20%'  ><?php echo $form->batch_name;?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Iqama ID');?>:</td>
											<td width='20%'  ><?php echo $form->iqama_id;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Iqama Expiry');?>:</td>
											<td width='20%'  ><?php echo Util::dateDisplayFormate($form->iqama_expiry);?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Passport Number');?>:</td>
											<td width='20%'  ><?php echo $form->passport_id;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Passport Expiry');?>:</td>
											<td width='20%'  ><?php echo Util::dateDisplayFormate($form->passport_expiry);?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Date of Birth');?>:</td>
											<td width='20%'  ><?php if(!is_null($form->date_of_birth) && $form->date_of_birth != '0000-00-00'){ echo Util::dateDisplayFormate($form->date_of_birth). ',  Age: '. Util::ageCalculator($form->date_of_birth);}?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Birth Place');?>:</td>
											<td width='20%'  ><?php echo $form->birth_place;?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Gender');?>:</td>
											<td width='20%'  ><?php echo $form->gender;?></td>	
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Religion');?>:</td>
											<td width='20%'  ><?php echo $form->religion;?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('City');?>:</td>
											<td width='20%'  ><?php echo $form->city;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('State');?>:</td>
											<td width='20%'  ><?php echo $form->state;?></td>
											<td width='30%' >&nbsp;</td>
										</tr>	
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Country');?>:</td>
											<td width='20%'  ><?php //echo $form->country_id;?>
											<?php foreach($country_list as $country){ 
												$country_id = $country->id;
												if($country_id ==  $form->country_id) { if($lang == 'ar') echo $country->country_ar; else echo $country->country_name; }
												} ?>
											</td>
										
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Nationality');?>:</td>
											<td width='20%'  ><?php //echo $form->nationality;?>
											<?php foreach($country_list as $country){ 
												$country_id = $country->id;
												if($country_id ==  $form->nationality) { if($lang == 'ar') echo $country->country_ar; else echo $country->country_name; }
												} ?>
											</td>
											<td width='30%' >&nbsp;</td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Transportation');?>:</td>
											<td width='20%'  ><?php 
													if($form->transportation == 'Yes'){
														echo ($form->transport_type == 'TRANSPORT_FEE') ? 'One Side' : 'Two Side';
													}
													else { echo 'No'; } ?>
											</td>
											<td width='15%' ></td>
											<td width='20%'  ></td>
											<td width='30%' >&nbsp;</td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Address Line1');?>:</td>
											<td width='20%'  ><?php echo $form->address_line1;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Address Line 2');?>:</td>
											<td width='20%'  ><?php echo $form->address_line2;?></td>
											<td width='30%' >&nbsp;</td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Phone 1');?>:</td>
											<td width='20%'  ><?php echo $form->cell_phone_father;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Phone 2');?>:</td>
											<td width='20%'  ><?php echo $form->cell_phone_mother;?></td>
											<td width='30%' >&nbsp;</td>
										</tr>
										</tbody>
									</table>	
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_2">
									Previous Academic Detail
									</a>
								</h4>
							</div>
							<div id="collapse_2_2" class="panel-collapse collapse">
								<div class="panel-body">
									<table class="table">
										<tbody><tr>
						                	<td align="<?php echo $class_left;?>" colspan="5" id="tblPrevData">
						                		<table width="100%">
						                		<?php if(sizeof($previous_data) > 0){
													$title = "::Update Previous Data::";
													foreach ($previous_data as $val) {
														$cell_id = $val->id; 
														$param = 'id='. $val->id .'&enrollment_id='.$val->enrollment_id;
														$url   = base_url().$model."/edit_previous_data";
												?>
												
												<tr>
													<td width='20%' style="vertical-align: top;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Institution');?>:</td>
													<td width='30%' style="vertical-align: top;" ><?php echo $val->institute;?></td>
													<td width='20%' style="vertical-align: top;" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Year');?>:</td>
													<td width='30%' style="vertical-align: top;" > <span style="float: left;"><?php echo $val->year;?></span> <span style="float: right;"><a href="#" <?php echo 'onclick="showInnerBox( [\''. $url .'\', \'_update\', \'previousDetailForm\', \'tblPrevData\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'})"'; ?>  >Edit</a></span></td>
												</tr>
												<tr>
													<td width='20%'><?php echo Base_Controller::ToggleLang('Course');?>:</td>
													<td width='30%'  ><?php echo $val->course;?></td>
													<td width='20%'><?php echo Base_Controller::ToggleLang('Total Mark');?>:</td>
													<td width='30%'  ><?php echo $val->total_marks;?></td>
													
												</tr>
												<?php } 
												} ?>
												</table>
											</td>
						                </tr>
										<tr>
											<?php 
											$param = 'enrollment_id='.$enrollment_id;
											$url   = base_url().$model."/add_previous_data";
											?>
											<td width='100%'  colspan="5">
											<a href="#" <?php echo 'onclick="showInnerBox( [\''. $url .'\', \'_insert\', \'previousDetailForm\', \'tblPrevData\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Add Previous Data\'})"'; ?> >Add another Previous Data</a></td>
										</tr></tbody>
									</table>
								</div>
							</div>
						</div>		
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_3">
									Parents Detail
									</a>
								</h4>
							</div>
							<div id="collapse_2_3" class="panel-collapse collapse">
								<div class="panel-body">
									<table class="table" >
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Father Name');?>:</td>
											<td width='30%'  ><?php echo $form->father_name;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Mother Name');?>:</td>
											<td width='30%'  ><?php echo $form->mother_name;?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Occupation');?>:</td>
											<td width='30%'  ><?php echo $form->occupation_father;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Occupation');?>:</td>
											<td width='30%'  ><?php echo $form->occupation_mother;?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Name of the Company');?>:</td>
											<td width='30%'  ><?php echo $form->work_place_father;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Name of the Company');?>:</td>
											<td width='30%'  ><?php echo $form->work_place_mother;?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Iqama Number');?>:</td>
											<td width='30%'  ><?php echo $form->id_number_father;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Iqama Number');?>:</td>
											<td width='30%'  ><?php echo $form->id_number_mother;?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Iqama Expiry');?>:</td>
											<td width='30%'  ><?php echo $form->iqama_expiry_father;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Iqama Expiry');?>:</td>
											<td width='30%'  ><?php echo $form->iqama_expiry_mother;?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Passport Number');?>:</td>
											<td width='30%'  ><?php echo $form->passport_father;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Passport Number');?>:</td>
											<td width='30%'  ><?php echo $form->passport_mother;?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Passport Expiry');?>:</td>
											<td width='30%'  ><?php echo $form->passport_expiry_father;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Passport Expiry');?>:</td>
											<td width='30%'  ><?php echo $form->passport_expiry_mother;?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Work Phone');?>:</td>
											<td width='30%'  ><?php echo $form->work_phone_father;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Work Phone');?>:</td>
											<td width='30%'  ><?php echo $form->work_phone_mother;?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Cell Phone');?>:</td>
											<td width='30%'  ><?php echo $form->cell_phone_father;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Cell Phone');?>:</td>
											<td width='30%'  ><?php echo $form->cell_phone_mother;?></td>
										</tr>
										<tr>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Email');?>:</td>
											<td width='30%'  ><?php echo $form->email_father;?></td>
											<td width='15%' ><?php echo Base_Controller::ToggleLang('Email');?>:</td>
											<td width='30%'  ><?php echo $form->email_mother;?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						
					</div>	
					<!--<div class="table-responsive">
						<table><tbody>
							 <tr>
			                	<td colspan="5" ><h3><?php echo Base_Controller::ToggleLang('Emergeny Contact');?></h3></td>
			                </tr>
							<tr>
								<td width='100%'  colspan="5" id="tblParentDetail">
								<?php if(sizeof($guardian) > 0){ $val = $guardian[0];?>
			                	In case of emergencies,<br>
								contact : <?php echo $val->first_name. ' ' .$val->last_name. ' ('. $val->mobile_phone . ')';
								$param = 'enrollment_id='.$val->enrollment_id;
								$url   = base_url().$model."/edit_parent_data";
								?>
								
								<a href="#" <?php echo 'onclick="showInnerBox( [\''. $url .'\', \'_update\', \'parentDetailForm\', \'tblParentDetail\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Update Parent Info\'})"'; ?> >Edit</a>
			                	
			                	<?php }else {
			                		$param = 'enrollment_id='.$enrollment_id;
			                		$url   = base_url().$model."/add_parent_data";
			                		echo '<a href="#" onclick="showInnerBox( [\''. $url .'\', \'_insert\', \'parentDetailForm\', \'tblParentDetail\'], \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \'Add Parent Info\'})" >Add</a> Contact Detail'; }?>
								</td>
							</tr>
							  
						</table>
					</div>	-->				
				</div>
			</div>
			<?php echo form_close();?>
			</div>
			<div class="tab-pane " id="tabs_1" style="height: 420px"><?php include "edit_attached_files.php"?></div>
		</div>
</div>
<!-- <input type="checkbox" name="selected_id_1" id="selected_id_1" value="<?php echo $form->enrollment_id;?>" />
<input type="hidden" id="count" value="1"/> -->
<div id="dialog-form"></div>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script>
	jQuery(document).ready(function() {    
	   // initiate layout and plugins
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
	            	    get(_url+'ance', '', 'div_attendance', false, 'attendForm');
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

			function showInnerBox(_url, params, options){
            	options = options || {};
            	var tag = $("#dialog-form"); //This tag will hold the dialog content.
            	$.ajax({
            	    url: _url[0] +'?'+params,
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
            	        		target_div = _url[3];
            	        		get(_url[0] + _url[1], '', target_div, false, _url[2]);
            	            	$( this ).dialog( "close" );
            	          	},
            	        	Cancel: function() {
            	            $( this ).dialog( "close" );
            	          	}
            	        }, title: options.title, width:700, height: 500, draggable: true }).dialog('open');
            	      }
            	      tag.dialog({ dialogClass: "noclose" });
            	      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
            	      
            	    }
            	});
            }

			function showOutstandings(_url, params, options){
            	options = options || {};
            	var tag = $("#dialog-form"); //This tag will hold the dialog content.
            	$.ajax({
            	    url: _url[0] +'?'+params,
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
            	        	Cancel: function() {
            	            $( this ).dialog( "close" );
            	          	}
            	        }, title: options.title, width:700, height: 500, draggable: true }).dialog('open');
            	      }

            	      tag.dialog({ dialogClass: "noclose" });
            	      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
            	    }
            	});
            }

			function afterAjax(){
				if(document.getElementById('after_ajax').value == 'Y'){
					document.getElementById('after_ajax').value = 'N';
					var sid = document.getElementById('enrollment_id').value;
					var val = document.getElementById('selected_batch').value;
				    get('<?php echo base_url().$model.'/get_fee_pending';?>', 'enrollment_id='+sid+'&batch_id='+val, 'pending_fee_div',false, '');
				}
			}
            function get_fee_detail(val){
            	document.getElementById('after_ajax').value = 'Y';
                var sid = document.getElementById('enrollment_id').value;
                get('<?php echo base_url().$model.'/get_fee_paid';?>', 'enrollment_id='+sid+'&batch_id='+val, 'paid_fee_div',false, '');
            }
            
			function close_payment(id){
                if(confirm('Are you sure to remove this transaction?')){
                	options = {error: function() { alert('Could not load form')} };
                	var tag = $("#paid_fee_div"); //This tag will hold the dialog content.
                	$.ajax({
                	    url: "<?php echo base_url().$model.'/close_payment/';?>"+id,
                	    type: (options.type || 'POST'),
                	    data: {
    	                    enrollment_id: $('#enrollment_id').val(),
    	                    batch_id: $('#batch_id').val()
    	                },
                	    beforeSend: options.beforeSend,
                	    complete: options.complete,
                	    success: function(data, textStatus, jqXHR) {
                	      if(typeof data == "object" && data.html) { //response is assumed to be JSON
                	        tag.html(data.html);
                	      } else { //response is assumed to be HTML
                	        tag.html(data);
                	      }                	      
                	      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
                	    }
                	});	
                }
            }
			
            function cheque_return(id){
                if(confirm('Are you sure to return this cheque?')){
					
                }
            }
   
			</script>
			<?php //echo $time_elapsed_secs = microtime(true) - $start;?>
		