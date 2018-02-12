<link type="text/css" href="<?php echo base_url();?>assets/css/redmond/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />	
				<form id="termPlanForm" method="post" action="<?php echo $model;?>">
					<input type="submit" id="f" style="display: none;" onclick="return false;">
					<input type="hidden" name="batch_id" id="batch_id" value="<?php echo $batch; ?>">
					<div class="form-body">
						<div class="row alert alert-success">
							<div class="col-md-6">
								<label class="control-label col-md-2 col-sm-2" ><?php echo Base_Controller::ToggleLang('Course');?></label>
								<?php 
								$c = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
								$admin_user = true;
								?>
								<div class="col-md-8 col-sm-9">
									<div class="form-group">
	    								<?php 
	    								if($admin_user){
	    									/* echo '<select name="division_id" id="division_id" class="form-control col-md-4 col-sm-2" style="width: 90px">
    												<option value="1" '; echo ($division_id == 1) ? 'selected' : ''; echo '> DNS</option>
    												<option value="2" '; echo ($division_id == 2) ? 'selected' : ''; echo '> DIS</option>
    											  </select>'; */
	    									echo '<select name="course_id" class="form-control col-md-8 col-sm-6" id="course_id" style="width: 150px" onchange="termPlanForm.submit();" >';
	    									foreach($courses_list as $course){
												$course_id = $course->course_id;
												$sel = ($course_id ==  $c) ?  'selected' : '' ;
												echo '<option value="'.$course_id.'" '.$sel.'>'.$course->course_name.'</option>';
											}
											echo '</select>';
											echo '<input type="hidden" name="division_id" class="form-control col-md-4" id="division_id" value="'.$division_id.'" style="width: 50px">';
											
										}else{
											foreach($courses_list as $course){
												$course_id = $course->course_id;
												if($course_id ==  $c) { $course_name = $course->course_name; break;}
											}
										?>
    									<input type="hidden" name="course_id" id="course_id" value="<?php echo $c; ?>">
    									<input type="text" name="course_name" readonly="readonly" class="form-control col-md-6" id="course_name" value="<?php echo $course_name; ?>" style="width: 150px">
    									<input type="text" name="division_id" readonly="readonly" class="form-control col-md-4" id="division_id" value="<?php echo $division_id; ?>" style="width: 50px">
    									<?php }?>
    								</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									
									<div class="col-md-5" >
										<?php $term_name = 'First';?>
										<select name="term" class="form-control" id="term" style="width: 170px" onchange="onchange_subject()">
											<?php foreach ($term_list as $t){ ?>
						                		<option value="<?php echo $t->id;?>" <?php  if(isset($_POST['term']) && ($_POST['term'] == $t->id)) { echo 'selected'; $term_name = $t->name;}?>> <?php echo $t->name;?> </option>
						                	<?php } ?>
						                	
										</select>
									</div>
									<div class="col-md-5" >
										<!-- <input type="text" name="subject" class="form-control" id="subject" value="<?php //echo $subject; ?>"> -->
										<select name="subject_id" class="form-control" id="subject_id" style="width: 220px" onchange="onchange_subject();">
						                    <?php foreach($subject_list as $sub){ 
				                    				$sid = $sub->subject_id.'-'.$sub->period_per_week;
				                    				$sel = (isset($_POST['subject_id']) && $_POST['subject_id'] == $sid) ? 'selected' : '';
						                    	?> 
						                    	<option value=<?php echo '"'.$sid.'" '.$sel;?> ><?php echo $sub->subject_code. ' ' .$sub->subject_name;?></option>
						                    <?php } ?>
										</select>
										<span id="span_detail"></span>
									</div>
									<div class="col-md-2" ></div>
								</div>
							</div>	
						</div>
						
						<div class="row alert alert-info">
							<div class="col-md-12" id="termplan_div">
					 		<table border="1" style="border: 1px solid #8CBAE8; width: 100%; background-color: #FFF; color: #000;">
				                <tr>
				                	<th width="50px"><?php echo Base_Controller::ToggleLang('Week');?></th>
				                	<th width="130px" style="text-align: center"><?php echo Base_Controller::ToggleLang('Date');?></th>
				                	<th><?php echo Base_Controller::ToggleLang('Chapter');?></th>
				                	<th><?php echo Base_Controller::ToggleLang('Class Work (text book pages)');?></th>
				                	<th><?php echo Base_Controller::ToggleLang('Home Work (text book pages)');?></th>
				                	<th><?php echo Base_Controller::ToggleLang('Weekend HW');?></th>
				                	<th></th>
				                </tr>
			                	<?php 
			                	$i = $term = 0; $week_count = 0;
			                	if(isset($term_plan_list) && sizeof($term_plan_list)>0){
			                		$week_count = sizeof($term_plan_list); 
			                		foreach ($term_plan_list as $row)
			                		{   $i++;
			                			if($term != $row->term)
			                			{
			                				$term = $row->term;
			                	?>
			                	<tr>
			                		<td colspan="6" style="text-align: center; font-weight: bold"><?php echo ($row->term == 1) ? 'First Term' : 'Second Term';?></td>
			                	</tr>
			                	<?php }?>
			                	<tr>
			                		<td style="padding-left: 12px">
			                			<?php if($row->week >= 1){ echo $row->week;} else { ?>
			                			<a href="#" class="btn btn-xs red" onclick="deleteRow(<?php echo $row->term_plan_id;?>)"><i class="fa fa-times"></i></a>
			                			<?php }?>
			                		</td>
			                		<td align="center"><?php echo $row->plan_date;?></td>
			                		<td align="center"><?php echo $row->chapter;?></td>
			                		<td align="center"><?php echo $row->classwork;?></td>
			                		<td align="center"><?php echo $row->homework;?></td>
			                		<td align="center"><?php echo $row->weekend_hw;?></td>
			                		
			                		<?php if($row->week >= 1){
			                			
			                			$title = "TERM PLAN INFO";
			                			$url   = base_url().$model."/add_week_plan";
										$param = 'week='.$row->week."&batch_id=".$row->batch_id."&term=".$row->term."&course_id=".$row->course_id."&subject_id=".$row->subject_id;
										$param .= '&id='.$row->term_plan_id.'&plan_date='.$row->date.'&chapter='.$row->chapter.'&classwork='.$row->classwork.'&homework='.$row->homework.'&weekend_hw='.$row->weekend_hw;
										$cell_id = $row->week.$row->term.$row->batch_id.$row->subject_id.$row->course_id;
			                			
			                			?>
			                		<td id="<?php echo $cell_id;?>" ><span style="float: left"></span>
			                			<span style="float: right"><a <?php echo 'onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \''.$cell_id.'\')"';?> href="#" class="btn btn-xs blue" ><i class="fa fa-edit"></i> Edit</a></span>
			                		</td>
			                		<?php } else { echo '<td></td>'; } ?>
			                	</tr>
			                	<?php }
			                	} 
			                	$chapter='CH '.$i;
			                	$hw='HW '.$i;
			                	$cw='CW '.$i;
			                	$weekend_hw='NO';
			                	if($week_count < 40){
			                		if(isset($row->end_date)){
			                			$curr_date = $row->end_date;
			                		}
			                		?>
                				    	<tr>
                				            <td></td>
                				            <td><input type="text" class="form-control input-sm date-picker" data-date-format="dd-mm-yyyy" size="16" id="plan_date" name="plan_date" value='<?php echo Util::displayFormat( $curr_date );?>' style="width: 120px"/></td>
                				            <td><input type="text" class="form-control input-sm" id="chapter" name="chapter" value='<?php echo $chapter;?>' style="width: 150px"/></td>
                				            <td><input type="text" class="form-control input-sm" id="classwork" name="classwork" value='<?php echo $cw;?>' style="width: 250px"/></td>
                				            <td><input type="text" class="form-control input-sm" id="homework" name="homework" value='<?php echo $hw;?>' style="width: 250px"/></td>
                				            <td><input type="text" class="form-control input-sm" id="weekend_hw" name="weekend_hw" value='<?php echo $weekend_hw;?>' style="width: 150px"/></td>
			                				<td><input type="button" class="btn btn-sm" value="Add" onclick="onclick_add_plan()"></td>
	                					</tr>
                				<?php }?>
			            	</table>
			            	</div>
					 	</div>
				 	</div>
			</form>
	        <input type="hidden" id="count" value="0"/>
	        <div id="dialog-form"></div>
	        
<script type="text/javascript" src="<?php echo base_url();?>assets/scripts/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
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

		function onclick_add_plan(){
			get('<?php echo base_url().$model.'/add_term_plan';?>', '', 'termplan_div','false','termPlanForm');
		}
		function onchange_subject(){
			var val = document.getElementById('subject_id').value; 
	        if(val != ''){
		        var arr = val.split('-');
		        document.getElementById('span_detail').innerHTML = arr[1] + ' Period Per Week';
		        var batch_id = document.getElementById('batch_id').value;
		        var course_id = document.getElementById('course_id').value;
		        var term = document.getElementById('term').value;
		        
		        get('<?php echo base_url().$model.'/subject_plan/';?>'+arr[0], 'batch_id='+batch_id+'&course_id='+course_id+'&term='+term+'&subject_id='+arr[0], 'termplan_div','false','');
	        }
        }

		function deleteRow(i){
			if(confirm('Are you sure to delete this record?')){
				get('term_plan/delete_term_plan', 'id='+i, 'termplan_div', false, 'termPlanForm');
			}
		}

		function showUrlInDialog(_url, params, options, cell_id){
				options = options || {};
            	var tag = $("#dialog-form"); //This tag will hold the dialog content.
            	$.ajax({
            	    url: _url,
            	    type: (options.type || 'POST'),
            	    data: params,
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
            	        	get(_url, '', 'termplan_div', false, 'addPlanForm');
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