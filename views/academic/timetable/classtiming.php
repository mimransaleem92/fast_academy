<?php  echo form_open('timetable/classtiming',array('id'=>'mainForm')); ?>
<div class="form-body">
	<div class="row alert alert-success">
		<div class="col-md-6">
			<label class="control-label col-md-3"><?php echo Base_Controller::ToggleLang('Course Name').' / '.Base_Controller::ToggleLang('Section');?></label>
			<?php 
			$b = isset($_POST['batch_id']) ? $_POST['batch_id'] : $this->session->userdata(SESSION_CONST_PRE.'batch_id');
			$c = isset($_POST['course_id']) ? $_POST['course_id'] : $this->session->userdata(SESSION_CONST_PRE.'course_id');
			$sec = isset($_POST['section']) ? $_POST['section'] : $this->session->userdata(SESSION_CONST_PRE.'section');
			$admin_user = ($this->session->userdata(SESSION_CONST_PRE.'role_id') == 1) ? true : false;
			?>
			<div class="col-md-7">
				<div class="form-group">
    			<?php 
    			if($admin_user){
    			echo '<select name="course_id" class="form-control col-md-6" id="course_id" style="width: 150px" onchange="onchange_courses(this.value);" >';
    			foreach($courses_list as $course){
					$course_id = $course->course_id;
					$sel = ($course_id ==  $c) ?  'selected' : '' ;
					echo '<option value="'.$course_id.'" '.$sel.'>'.$course->course_name.'</option>';
				}
				echo '</select>';
				echo '<input type="text" name="section" class="form-control col-md-4" id="section" value="'.$sec.'" style="width: 50px">';
				}else{
					foreach($courses_list as $course){
						$course_id = $course->course_id;
						if($course_id ==  $c) { $course_name = $course->course_name; break;}
					}
				?>
    			<input type="hidden" name="course_id" id="course_id" value="<?php echo $c; ?>">
    			<input type="text" name="course_name" readonly="readonly" class="form-control col-md-6" id="course_name" value="<?php echo $course_name; ?>" style="width: 150px">
    			<input type="text" name="section" readonly="readonly" class="form-control col-md-4" id="section" value="<?php echo $sec; ?>" style="width: 50px">
    		<?php }?>
	    		</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-md-3 right"><?php echo Base_Controller::ToggleLang('Batch');?></label>
				<div class="col-md-6" id="td_batch">
					<select name="batch_id" class="form-control" id="batch_id" onchange="onchange_batch(this.value);">
	                   	<?php 
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
	</div>
	<div class="row alert alert-info" >
		<div style="background-color:#FFFFFF;" id="td_classtiming">
		
		</div>
	</div>
</div>
        <?php echo form_close();?>       
		<script> 
	        function onchange_courses(val){
		        if(val != ''){
		        	var batch = document.getElementById('batch_id').value;
		        	var sec = document.getElementById('section').value;
	        		get('<?php echo base_url().'timetable/ct_list/';?>'+batch, 'course_id='+val+'&section='+sec, 'td_classtiming','false','');
		        }
	        }
	        onchange_courses(<?php echo $c;?>);
	        function onchange_batch(val){
	        	document.getElementById('td_classtiming').innerHTML = "";
		        if(val != ''){
			        var c = document.getElementById('course_id').value;
			        var sec = document.getElementById('section').value;
	        		get('<?php echo base_url().'timetable/ct_list/';?>'+val, 'course_id='+c+'&section='+sec, 'td_classtiming','false','');
		        }
	        }

	        function onclick_saveclasstiming(){
	        	var bid = document.getElementById('batch_id').value;
		        if(bid != ''){
		        	get('<?php echo base_url().'timetable/ct_update/';?>'+bid, '', 'td_classtiming', 'false','mainForm');
		        }
	        }
        </script>      