			<?php  
			echo form_open('students/add_emergency_detail',array('id'=>'emergencyDetailForm'));
			$today    = date('Y-m-d');
			?>
			
			<table width="700" border="0" cellspacing="3" cellpadding="0">
				<tr>
					<td align="center">
						<input type="hidden" name="student_id" id="student_id" value="<?php // echo $form->student_id;?>" />
						<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
						<tbody>
							<tr>
								<td align="<?php echo $class_left;?>" colspan="3" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1"><?php echo Base_Controller::ToggleLang('Emergency Details');?></span></td>
							</tr>
							<tr> 	
								<td width='50%' style="border-bottom: 1px solid #8CBAE8;" align="center"><?php echo Base_Controller::ToggleLang('Guardian Name');?></td>
								<td width='50%' style="border-bottom: 1px solid #8CBAE8;" align="center"><?php echo Base_Controller::ToggleLang('Relationship');?></td>
							</tr>
							<?php if(sizeof($guardian)>0){
							foreach ($guardian as $g){
					 
				
							?>
							
							<tr>
								<td width='50%' style="border-bottom: 1px solid #8CBAE8;" align="center">
									<input class='' type="radio" name="default_contact" id="default_contact" value='1'/> <?php echo $g->first_name. " ".$g->last_name;?> </td>
								<td width='50%' style="border-bottom: 1px solid #8CBAE8;" align="center"><?php echo $g->relation;?></td>
							</tr>
							
							<?php } }?>
						</table>
					</td>
				</tr>		
			</table>
			<?php echo form_close();?>