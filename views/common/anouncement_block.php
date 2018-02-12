<table width="100%" cellspacing="0" cellpadding="4" border="0" class="whitebgBorder"> 
   <tbody>
	   <tr id='note_0' style="cursor: pointer;">
            <td align="left" colspan="4"  class="listViewTableHeader tableHead">
            <span class="fontBlackBold FontColorStyle1" style="float:left" onclick="javascript:toggleBlock('note');" > Announcements </span>
            <span class="fontBlackBold FontColorStyle1" style="float:right" onclick="open_view('<?php echo base_url().$model."/addnote/?form_id=".$formId."&form_type=".$formType;?>')">Add Note</span>
            </td>
       </tr>
       <?php 
       $row_count = 1;
       if(isset($request_notes) && sizeof($request_notes) > 0){
          foreach ($request_notes as $value){
          $date = ($value->date);
          $row_count++;
          ?>
          <tr id='note_<?php echo $row_count;?>'>
	       	<td width="" valign="top" align="left" class="fontBlack" style="padding-left:4px;"><?php echo $value->subject;?></td>
	       	<td width="25%" align="left" valign="top" class="fontBlack" nowrap="nowrap"><?php echo $value->name;?></td>
	       	<td width="20%" align="left" valign="top" class="fontBlack"><?php echo $date;?></td>
	    </tr>
          <?php 
          }
       }
       ?>
      </tbody>
</table>
<input type="hidden" id="note_count" value="<?php echo $row_count;?>" />