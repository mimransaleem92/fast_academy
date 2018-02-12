<?php
 $values = $student[0];
?>
<div style="background-image: url(<?php echo base_url().'assets/images/default_card.png';?>); height: 290px; width: 445px;">
<table width="445px" border="0" >
<tr height="50px">
	<th colspan="2" align="left" style="width: 300px;padding-left: 18px; padding-top:8px"><?php echo $this->session->userdata(SESSION_CONST_PRE.'company_name');?></th>
	<th rowspan="5" width="145px" style="padding-top:10px">
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
	&nbsp;</th>
</tr>
<tr height="30px">
	<td width="90px">&nbsp;</td>
	<td valign="bottom"><?php echo $values->student_id;?></td>
</tr>
<tr height="30px">
	<td>&nbsp;</td>
	<td><?php echo $values->student_name;?></td>
</tr>
<tr height="30px">
	<td>&nbsp;</td>
	<td><?php echo $values->batch_name;?></td>
</tr>
<tr height="30px">
	<td>&nbsp;</td>
	<td><?php echo $values->course_name;?></td>
</tr>
<tr height="30px">
	<td>&nbsp;</td>
	<td><?php echo $values->blood_group;?></td>
</tr>
<tr height="30px">
	<td>&nbsp;</td>
	<td><?php echo " Issued on:" . date('d-m-Y') ;?></td>
</tr>
</table>
</div>