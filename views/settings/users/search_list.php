					<table width="99%" border="0" cellspacing="0" cellpadding="0" style="cursor:pointer">
                        <tr>
                            <td width="4%" class="frame_blue"><label></label></td>
                            <td width="4%" class="frame_blue"><?php echo Base_Controller::ToggleLang('P/No');?></td>
                            <td width="*" class="frame_blue"><?php echo Base_Controller::ToggleLang('Name');?></td>
                            <td width="15%" class="frame_blue"><?php echo Base_Controller::ToggleLang('Role');?></td>
                            <td width="10%" class="frame_blue"><?php echo Base_Controller::ToggleLang('Dept Code');?></td>
                            <td width="10%" class="frame_blue"><?php echo Base_Controller::ToggleLang('Is Active');?></td>
                          </tr>
                  		<?php
                  		  $i=0; 
                          if(isset($user_list) && sizeof($user_list) > 0){
                          	
                          	foreach($user_list as $values){
                          		$i++;
                          		$class = "frame_blue_light";
                          		if($i%2==0){
                          			$class = "frame_blue_dark";
                          		}
                          ?>
	                          <tr>
	                            <td class="<?php echo $class; ?>"><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" value="<?php echo $values->user_id;?>" /></td>
	                            <td onclick="onclick_row('<?php echo $i;?>');" class="<?php echo $class; ?>" style="color:#888888;"><strong><?php echo $values->user_id; ?></strong></td>
	                            <td onclick="onclick_row('<?php echo $i;?>');" class="<?php echo $class; ?>"><?php echo $values->name?></td>
	                            <td onclick="onclick_row('<?php echo $i;?>');" class="<?php echo $class; ?>"><?php echo $values->role_name;?></td>
	                            <td onclick="onclick_row('<?php echo $i;?>');" class="<?php echo $class; ?>"><?php echo $values->dept_code;?></td>	                          
	                            <td onclick="onclick_row('<?php echo $i;?>');" class="<?php echo $class; ?>">
	                            <?php $is_active = $values->is_active;
	                            if($is_active == 1)
	                            {
	                            	echo Base_Controller::ToggleLang('Yes');
	                            }
	                            else {
	                            	echo Base_Controller::ToggleLang('No');
	                            }
	                            ?></td>
	                          </tr>
	                  <?php 	}
                          }
                          	?>
	                </table>
	                <input type="hidden" id="count" value="<?php echo $i;?>"/>
	                <ul id="pagination-digg" class="ajax-pag"><?php if (isset($links)) echo $links;?></ul>