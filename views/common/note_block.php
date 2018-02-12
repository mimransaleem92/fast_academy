<table width="100%" cellspacing="0" cellpadding="4" border="0" class="table table-striped table-bordered table-advance table-hover" >
	<thead>
		<tr id='note_1'>
			<th width="25%" >User Name</th>
			<th width="" >Note</th>
			<th width="10%" >Access</th>
			<th width="15%" >
				<span style="float:left;">Date</span>
	       		<span style="float:right; cursor:pointer;" onclick="open_view('<?php echo base_url()."tickets/addnote/?form_id=".$formId."&form_type=".$formType."&emp_num=".$emp_num;?>')">Add Note </span>
	       	</th>
		</tr>
   	</thead> 
   	<tbody>
       <?php 
       $row_count = 1;
       if(isset($request_notes) && sizeof($request_notes) > 0){
          foreach ($request_notes as $value){
          $date = ($value->date);
          $row_count++;
          ?>
          <tr id='note_<?php echo $row_count;?>'>
	       	<td width="15%" valign="top" align="left" nowrap="nowrap"><?php echo $value->name;?></td>
	       	<td width="" valign="top" align="left"><?php echo $value->subject;?></td>
	       	<td width="15%" valign="top" align="left"><?php echo $value->access;?></td>
	       	<td width="15%" valign="top" align="left"><?php echo $date;?></td>
	    </tr>
          <?php 
          }
       }
       ?>
      </tbody>
</table>
<input type="hidden" id="note_count" value="<?php echo $row_count;?>" />