		<?php echo form_open('subjects/edit_header', array('id'=>'marksForm')); ?>
			<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
				
				<tr >
					<td width='20%' align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Subject Name');?>:</td>
					<td width='50%'>
					<input type="text" class="form-control input-sm" readonly="readonly" id="subject_name" name="subject_name" value='<?php  echo $_GET['subject_name']; ?>' /></td>
					<td width='30%'></td>
				</tr>
				<?php $total = 0;
					if(isset($header_title) && sizeof($header_title)>0){ 
				      foreach ($header_title as $i=>$name){ 
				      	$field= ''.($i+1). '. Title / Marks';
				      	
				      ?>
				      <tr>	
				      	<td><?php echo $field?>:</td>
				      	<td><input type="text" class="form-control input-sm" id="field<?php echo $i+1;?>" name="field<?php echo $i+1;?>" value='<?php echo $name;?>' /></td>
				      	<td><input type="text" class="form-control input-sm" onkeypress="keyPressAllowFloatOnly(event,this);" style="text-align: right" id="score<?php echo $i+1;?>" name="score<?php echo $i+1;?>" value='<?php echo $header_score[$i];?>' /></td>
				      </tr>
				<?php } }
					  if( count($header_title) < 8 ){
						  for ($i=count($header_title); $i<8; $i++){ $field= ''.($i+1) . '. Title / Marks'; ?>
							  <tr>	
						      	<td><?php echo $field?>:</td>
						      	<td><input type="text" class="form-control input-sm" id="field<?php echo $i+1;?>" name="field<?php echo $i+1;?>" value='' /></td>
						      	<td><input type="text" class="form-control input-sm" onkeypress="keyPressAllowFloatOnly(event,this);" style="text-align: right" id="score<?php echo $i+1;?>" name="score<?php echo $i+1;?>" value='' /></td>
						      </tr>
				<?php 	  }
					  }	?>
			</table>
				<input type="hidden" id="course_id" name="course_id" value="<?php echo $_GET['course_id'];?>"/>
				<input type="hidden" id="subject_id" name="subject_id" value="<?php if (isset($_GET['sid'])) echo $_GET['sid'];?>"/>
				
		<?php echo form_close(); ?>