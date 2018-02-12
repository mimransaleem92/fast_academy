			<?php  
		    $form = $form[0];
		    $name = explode(' ', $form->employee_name);
		    echo form_open('employee/save_crop',array('id'=>'mainForm', 'enctype'=>'multipart/form-data'));
		    echo form_hidden("employee_id",$form->employee_id);
			?>
			<script type="text/javascript">
			<!--
			function onclickUpload(){
				var attach_file = document.getElementById('attached_file').value;
				if(attach_file.length == 0){
					document.getElementById('attached_file').focus();
					document.getElementById('attach_file_span').innerHTML = 'Please select image to upload.';
					return false;
				}
				document.getElementById('attach_file_span').innerHTML = '';
				return onSubmit();
			}
			//-->
			</script>
			<table width="700" border="0" cellspacing="3" cellpadding="0">
				<tr>
					<td align="center">
						<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
			                <tbody><tr>
			                	<td align="<?php echo $class_left;?>" colspan="4" class="reqFormsubHead"><span class="fontBlackBold FontColorStyle1"><?php echo Base_Controller::ToggleLang('Employee Basic Information');?>: </span> <?php echo $form->employee_code;?></td>
			                </tr>		
							<tr style="height: 100px">
								<td width='*' align="<?php echo $class_left;?>" style="padding:4px;" valign="top"><?php echo Base_Controller::ToggleLang('Employee Name'). ': ' . $form->employee_name;?> </td>
								<td width='100px' align="<?php echo $class_right;?>" style="padding:4px;">
									<?php if(is_null($form->employee_image) || empty($form->employee_image)){?>
									<img alt="nophoto" src="<?php echo base_url();?>assets/images/uploads/NoPicture.gif" height="96px" width="96px">
									<?php }else{?>
									<img alt="photo" src="<?php echo base_url()."assets/images/uploads/96x96/".$form->employee_image;?>" >
									<?php }?>
								</td>
							</tr>
							
							<tr >
								<td colspan="2">
									Upload Photo: <input type="file" name="attached_file" id="attached_file" class="formStyle" /> &nbsp;
						        	<input type="submit" style="WIDTH: auto" id="addWOButton" class="formStylebuttonAct" value="Upload" onclick="return onclickUpload();"/> &nbsp;
						        	<span class=error_msg id="attach_file_span"></span>
								</td>
							</tr>
						</table>
					</td>
				</tr>				
			</table>
			<?php echo form_close();?>