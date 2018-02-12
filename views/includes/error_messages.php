<?php //if(isset($error_message) && !empty($error_message)){?>	
	<tr><td>	
		<table id="tblError" width="100%" border="0" cellspacing="0" cellpadding="0" style="<?php if(isset($error_message) && strlen($error_message)>0){ echo 'display:block;';}else{echo "display:none;";}?>">
		  <tr>
			<td width="6%" align="<?php echo $class_right;?>"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/error_left.jpg" alt="" width="38" height="34" /></td>
			<td id="error_td" width="88%" align="<?php echo $class_left;?>" class="error_msg"><?php if(isset($error_message)){ echo $error_message; }?></td>
			<td width="5%" align="<?php echo $class_right;?>" onclick="message_close();" class="error_msg"><a href="#"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/error_cross.jpg" alt="" width="18" height="18" border="0" /></a></td>
			<td width="1%" align="<?php echo $class_left;?>"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/error_right.jpg" alt="" width="6" height="34" /></td>
		  </tr>
		</table>
	</td></tr>   
<?php
 if((isset($success_message) && !empty($success_message)) OR isset($_GET['message'])){?>           
	<tr><td>	
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="6%" align="<?php echo $class_right;?>"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/success_left.jpg" alt="" width="18" height="34" /></td>
                <td width="88%" align="<?php echo $class_left;?>" class="success_msg"><?php echo (isset($_GET['message']) && $_GET['message']==1) ? "Successfully Update" : $success_message;?></td>

                <td width="5%" align="<?php echo $class_right;?>" class="success_msg"><a href="#"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/success_cross.jpg" alt="" width="18" height="18" border="0" /></a></td>
                <td width="1%" align="<?php echo $class_left;?>"><img src="<?php echo base_url();?>assets/images/<?php echo $lang;?>/success_right.jpg" alt="" width="6" height="34" /></td>
              </tr>
		</table>
	</td></tr>   
<?php }?>

