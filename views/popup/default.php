					<script type="text/javascript">
					<!--
					function assign_value(){
					}	
					//-->
					</script>
					<?php 
					/*$attributes = array(
					    'class'     =>  'blue-button',
					    'width'     =>  '800',
					    'height'    =>  '600',
					    'screenx'   =>  '\'+((parseInt(screen.width) - 800)/2)+\'',
					    'screeny'   =>  '\'+((parseInt(screen.height) - 600)/2)+\'',
					);
					echo anchor_popup('rfq/edit/2', 'Start Worksheet', $attributes);*/
					
					?>
					<!--<input type="button" name="btnPopup" id="btnPopup" value="Popup" onclick="callAJAX('/trade/index.php/rfq/printhtml/2',1);"/>-->
					<table width="100%" border="0" cellspacing="0" cellpadding="0" style="cursor:pointer">
                        <tr>
                            <td width="4%" class="frame_blue"><label></label></td>
                            <td width="15%" class="frame_blue"><?php echo Base_Controller::ToggleLang('Popup ID');?></td>
                            <td width="15%" class="frame_blue"><?php echo Base_Controller::ToggleLang('Name');?></td>
                          </tr>
                  		<?php
                  		$i=0;
                          if(isset($list) && sizeof($list) > 0){
                          	
                          	foreach($list as $values){
                          		$i++;
                          		$class = "frame_blue_light";
                          		if($i%2==0){
                          			$class = "frame_blue_dark";
                          		}
                          ?>
	                          <tr>
	                            <td class="<?php echo $class; ?>"><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" value="<?php echo $values->supplier_id;?>" /></td>
	                            <td class="<?php echo $class; ?>" style="color:#888888;"><strong><?php echo $values->supplier_id; ?></strong></td>
	                            <td class="<?php echo $class; ?>"><?php echo $values->name; ?></td>                          
	                          </tr>
	                  <?php 	}
                          }
                          	?>
	                </table>
	                <input type="hidden" id="count" value="<?php  echo $i;?>"/>
	                <p><?php if (isset($links)) echo $links;?></p>