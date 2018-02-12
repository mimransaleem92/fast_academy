					<table width="100%" border="0" cellspacing="0" cellpadding="0" style="cursor:pointer">
                        <tr>
                            <td width="4%" class="frame_blue"><label></label></td>
                            <td width="4%" class="frame_blue"><?php echo Base_Controller::ToggleLang('ID');?></td>
                            <td width="28%" class="frame_blue"><?php echo Base_Controller::ToggleLang('Name');?></td>
                            <td width="28%" class="frame_blue"><?php echo Base_Controller::ToggleLang('Arabic Name');?></td>
                          </tr>
                  		<?php 
                          if(isset($branch_list) && sizeof($branch_list) > 0){
                          	$i=0;
                          	foreach($branch_list as $values){
                          		$i++;
                          		$class = "frame_blue_light";
                          		if($i%2==0){
                          			$class = "frame_blue_dark";
                          		}
                          ?>
	                          <tr>
	                            <td class="<?php echo $class; ?>"><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" value="<?php echo $values->branch_id;?>" /></td>
	                            <td class="<?php echo $class; ?>" style="color:#888888;"><strong><?php echo $i; ?></strong></td>
	                            <td class="<?php echo $class; ?>"><?php echo $values->name?></td>
	                            <td class="<?php echo $class; ?>"><?php echo $values->arabic_name;?></td>	                          
	                          </tr>
	                  <?php 	}
                          }
                          	?>
	                </table>
	                <input type="hidden" id="count" value="<?php echo $i;?>"/>
	                <p><?php if (isset($links)) echo $links;?></p>