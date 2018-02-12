<table class="table table-bordered table-striped">

	<thead>
		<tr>
			<th width="20%" style="padding-left:4px;"> ID </th>
			<th width="20%" nowrap="nowrap"> Fee Month </th>
			<th width="*" nowrap="nowrap"> Date Time </th>
			<th width="20%" nowrap="nowrap"> Students </th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$colorCounter = 0;
		if(isset($branchs_list) && sizeof($branchs_list) > 0){
			foreach ($branchs_list as $value){
			?>
			<tr>
				<td width="20%" valign="middle" style="padding-left:4px;"><?php echo $value->id;?></td>
				<td width="*" valign="middle" nowrap="nowrap"><?php echo $value->month;?></td>
				<td width="115px" valign="middle" ><?php echo $value->created_at;?></td>
				<td width="20%" valign="middle" style="padding-left:4px;"><?php echo $value->total_students;?></td>
			</tr>
			<?php
			$colorCounter++;
		    }
	   }
	?>
</tbody></table>