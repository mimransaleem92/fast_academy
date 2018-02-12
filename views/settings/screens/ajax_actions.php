<?php 
$display = '';$screen_list='';
foreach($selected_scr as $v){ $sid = $v->screen_id; 
  $screen_list .= ",".$sid;
?>
<span id='spn<?php echo $sid;?>' style="<?php echo $display;?>"> 
	<?php foreach($actions as $r){ 
	$id = $r->action_id;
	?> 
	<input type="checkbox" name="screen_action-<?php echo $sid.'-'.$id;?>" id="screen_action-<?php echo $sid.'-'.$id;?>" value="<?php echo $id;?>"> <?php echo $r->name;?> &nbsp;&nbsp; 
	<?php } ?>
	</span>
	<?php $display = 'display:none';
}
$screen_list = substr($screen_list, 1, strlen($screen_list));
echo "<span style='display:none' id='spn_screen'>$screen_list</span>";
?>
