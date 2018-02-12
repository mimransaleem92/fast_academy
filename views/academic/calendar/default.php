<link type="text/css" href="<?php echo base_url();?>assets/css/redmond/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />	
				<form id="academicForm" method="post" action="<?php echo $model?>/add_calendar">
					<div class="form-body">
						<div class="row alert alert-success">
							<label class="control-label col-md-2"><?php echo Base_Controller::ToggleLang('Academic Year');?>:</label>
							<div class="col-md-3">
    							<div class="form-group">
    								<?php  
    								$b = isset($_POST['batch_id']) ? $_POST['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
    								$admin_user = ($this->session->userdata(SESSION_CONST_PRE.'role_id') == 1) ? true : false;
    								if($admin_user){ ?>
    								<select name="batch_id" class="form-control" id="batch_id" >
				                    	<?php 
				                    	foreach($batch_list as $batch){
				                    		$batch_id = $batch->batch_id;
				                    		$sel = ($batch_id ==  $b) ?  'selected' : '' ;
				                    		echo '<option value="'.$batch_id.'" '.$sel.'>'.$batch->batch_name.'</option>';
				                    	}
				                    	?>
									</select>
									<?php }else { 
												foreach($batch_list as $batch){
													$batch_id = $batch->batch_id;
													if($batch_id ==  $b) { $batch_name = $batch->batch_name; break;}
												}
									?>
									<input type="text" name="batch_id" readonly="readonly" class="form-control col-md-10" id="batch_id" value="<?php echo $batch_name;?>" />
									<?php }?>
    							</div>
    						</div>
    						<div class="col-md-5"></div>	
						</div>
						
						<div class="row alert alert-info">
							<div class="col-md-10">
					 		<table border="1" style="border: 1px solid #8CBAE8; width: 100%; background-color: #FFF; color: #000;">
				                <tr>
				                	<th width="50px"><?php echo Base_Controller::ToggleLang('Week');?></th>
				                	<th width="200px" style="text-align: center"><?php echo Base_Controller::ToggleLang('Date');?></th>
				                	<th><?php echo Base_Controller::ToggleLang('Plan');?></th>
				                </tr>
			                	<?php 
			                	$term = 0; $week_count = 0;
			                	if(isset($calendar_list) && sizeof($calendar_list)>0){
			                		$week_count = sizeof($calendar_list);
			                		foreach ($calendar_list as $row)
			                		{
			                			if($term != $row->term)
			                			{
			                				$term = $row->term;
			                				
			                				foreach ($term_list as $t){
			                					if($row->term == $t->id) {
			                						$term_name =  $t->name; break;
			                					}
			                				}
			                	?>
			                	<tr>
			                		<td colspan="3" style="text-align: center; font-weight: bold"><?php echo $term_name;?></td>
			                	</tr>
			                	<?php }?>
			                	<tr>
			                		<td style="padding-left: 12px"><?php echo $row->week_number;?></td>
			                		<td align="center"><?php echo $row->start_dt . ' - ' .$row->end_dt;?></td>
			                		<?php if($row->plan_num_week >= 1){
			                			
			                			$title = "WEEK PLAN INFO";
			                			$url   = base_url().$model."/add_week_plan";
										$param = 'week_number='.$row->week_number."&batch_id=".$row->batch_id."&term=".$row->term."&num=".$row->plan_num_week."&break=".$row->week_break."&week_plan=".$row->week_plan;
			                			$cell_id = $row->week_number.$row->term.$row->batch_id;
			                			
			                			?>
			                		<td id="<?php echo $cell_id;?>" rowspan="<?php echo $row->plan_num_week;?>"><span style="float: left"><?php echo $row->week_plan;?></span>
			                			<span style="float: right"><a <?php echo 'onclick="showUrlInDialog(\''.$url.'\', \''.$param.'\', {error: function() { alert(\'Could not load form\')}, title: \''.$title.'\'}, \''.$cell_id.'\')"';?> href="#" class="btn btn-xs blue" ><i class="fa fa-edit"></i> Edit</a></span>
			                		</td>
			                		<?php }?>
			                	</tr>
			                	<?php }
			                	} 
			                	
			                	if($week_count < 40){
				                	if(isset($row->end_date)){
				                		$curr_date = $row->end_date;
				                	}
			                	?>
			                	<tr>
			                		<td></td>
			                		<td colspan="2">
			                			<div class="form-group">
			                			<input type="text" class="form-control input-sm form-control-inline date-picker" data-date-format="dd-mm-yyyy" size="16" id="start_date" name="start_date" value='<?php echo Util::displayFormat( $curr_date );?>' style="width: 150px"/>
			                			
			                			<select id="batch_id" name="batch_id" class="form-control input-sm" style="width: 150px" data-placeholder="Choose" tabindex="1">
											<?php 
												if(isset($batch_list) && sizeof($batch_list)>0){ $i = 0; $count = sizeof($batch_list); 
												foreach($batch_list as $batch){ $i++;
												$batch_id = $batch->batch_id;
												$select = '';
												if(isset($_POST['batch_id']) && $_POST['batch_id'] == $batch_id) $select = 'selected';
												else if( $i == $count ) $select = 'selected';
												?> 
													<option value="<?php echo $batch_id;?>" <?php echo $select; ?> ><?php echo $batch->batch_name;?></option>
												<?php }
												} ?>
										</select>
			                			
			                			<select id="term" name="term" class="form-control input-sm" style="width: 150px" data-placeholder="Choose Term" tabindex="1">
			                				<?php foreach ($term_list as $t){ ?>
						                		<option value="<?php echo $t->id;?>" <?php if($week_count >= $t->id*10 ) echo 'disabled';   if(isset($_POST['term']) && ($_POST['term'] == $t->id)) { echo 'selected'; $term_name = $t->name;}?>> <?php echo $t->name;?> </option>
						                	<?php } ?>
											
										</select>
										
				                		<input type="submit" class="btn btn-sm" value="Submit"></div>
				                	</td>
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
            	        	get(_url, '', cell_id, false, 'calendarForm');
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