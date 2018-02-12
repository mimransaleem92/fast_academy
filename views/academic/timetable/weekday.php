<?php  echo form_open('timetable/update_wd',array('id'=>'mainForm')); ?>
	<div class="form-body">
		<div class="row alert alert-success">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3 right"><?php echo Base_Controller::ToggleLang('Session');?></label>
					<div class="col-md-6" id="td_batch">
						<select name="batch_id" class="form-control" id="batch_id" onchange="onchange_batch(this.value)">
	                    	<option value="">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
	                    	<?php 
	                    	$b = isset($_POST['batch_id']) ? $_POST['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
	                    	foreach($batch_list as $batch){
	                    		$batch_id = $batch->batch_id;
	                    		$sel = ($batch_id ==  $b) ?  'selected' : '' ;
	                    		echo '<option value="'.$batch_id.'" '.$sel.'>'.$batch->batch_name.'</option>';
	                    	}
	                    	?>
						</select>
					</div>
					<label class="control-label col-md-3">&nbsp;</label>
				</div>
			</div>
			<div class="col-md-6"></div>
		</div>
		
		<div class="row alert alert-info" id="td_weekdays">
	 		<?php echo Base_Controller::ToggleLang('Please select course and batch'); ?>!!
	 	</div>
 	</div>
<?php echo form_close();?> 
		<script> 

	        function onchange_batch(val){
	        	document.getElementById('td_weekdays').innerHTML = "";
		        if(val != ''){
	        		get('<?php echo base_url().'students/weekdays/';?>'+val, '', 'td_weekdays','false','');
		        }
	        }
	        onchange_batch(<?php echo $b;?>);
	        
	        function onclick_saveweekday(){
	        	var bid = document.getElementById('batch_id').value;
		        if(bid != ''){
	        		get('<?php echo base_url().'timetable/weekday_update/';?>'+bid, '', 'td_success','false','mainForm');
		        }
	        }
        </script>      