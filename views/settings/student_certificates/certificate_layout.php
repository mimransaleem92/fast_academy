<?php
 $values = $student[0];
?>
<div style="background-image: url(<?php echo base_url().'assets/images/certificate.jpg';?>); height: 414px; width: 600px;">
<table width="600px" border="0" >
<tr height="50px">
	<th align="center" style="width: 300px;padding-top:8px"></th>
	<!-- <th rowspan="5" width="145px" style="padding-top:10px">
	<?php 
	$file_name = $values->student_id;
	$dir_path = 'assets/uploads/students/';
	$filetype_arr = array('.jpg', '.jpeg', '.png', '.gif');
	foreach($filetype_arr as $type){
		$filepath = $dir_path.$file_name.$type;
		if( file_exists($filepath)) {
			$file_name = $file_name.$type;
			break;
		}
		$filepath = '';
	}
	?>
	<img src="<?php echo base_url().'assets/uploads/students/'.$file_name;?>" width="125" height="170" />
	&nbsp;</th>-->
</tr>
<tr height="30px">
	<td width="90px" valign="bottom"><?php //echo $values->student_id;?></td>
</tr>
<tr height="35px">
	<td valign="bottom" align="center"><?php echo $this->session->userdata(SESSION_CONST_PRE.'app_title');?> would like to thank</td>
</tr>
<tr height="30px">
	<td>&nbsp;</td>
</tr>
<tr height="30px">
	
	<td align="center"><?php echo $values->student_name;?></td>
</tr>
<tr height="55px">
	
	<td><?php //echo $values->blood_group;?>&nbsp;</td>
</tr>
<tr height="30px">
	<td align="center"><?php echo (isset($_GET['event_name'])) ? $_GET['event_name'] : 'Event Name';?></td>
</tr>
<tr height="30px">
	<td align="center"><?php echo (isset($_GET['event_date'])) ? $_GET['event_date']: date('d/m/Y'); echo " & "; echo (isset($_GET['event_place'])) ? $_GET['event_place'] : 'Riyadh';?></td>
</tr>
</table>
</div>