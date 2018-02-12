			<table id="form_tbl" width="98%" border="0" cellpadding="0" cellspacing="0" class="whitebgBorder" style="margin-top:2px; border:1px solid #8CBAE8;">
              <tr class="listViewTableHeader tableHead" style="height: 25px" >
                    <td align="center">Sr</td>
                    <td align="left" width="120px" style="padding:4px;">Voucher</td>
                    <td align="left" nowrap="nowrap" >Code 1</td>
                    <td align="left" nowrap="nowrap" >Code 2</td>
                    <td align="left" nowrap="nowrap" >Customer Name</td>
                    <td align="left" nowrap="nowrap" >Branch Issued</td>
                    <td align="left" >City</td>
                    <td align="left" nowrap="nowrap" >Contact</td>
                    <td align="left" nowrap="nowrap" >Date</td>
                    <td align="center" nowrap="nowrap" >Status</td>
             </tr>
                  <?php 
                  $colorCounter = 0; $count = 0;
                  if(sizeof($request_list) == 0){                  	
                  ?>
                  <tr><td height="70" valign="middle" align="center" colspan="5" > No Request Found</td></tr>
                  <?php }else{
                  
				  $rowColor     = '#2B9CFB';
				  $rowTextColor = '#FFFFFF';
                  foreach($request_list as $row){			                  		
                  	if($colorCounter % 2 == 0)
					{
						$rowColor     = Util::_rowColor;
						$rowTextColor = Util::_rowTextColor;
					}
					else 
					{
						$rowColor     = '#FFFFFF';
						$rowTextColor = Util::_rowTextColor;
					}
                  	
                  	$url = "window.open('', '_self');";
                  	$count++;
                  ?>
                  <tr <? echo "id='row$colorCounter' class='grid_detail' style='height: 25px; color:$rowTextColor; background-color:$rowColor;' onmouseover='overStyle(this.id)' onmouseout=\"outStyle('$colorCounter','$rowTextColor','$rowColor')\" ";?> >	
                    <td align="center"><?php echo $count;?></td>
                    <td align='left' class='fields_r' style="padding-left:4px;" nowrap='nowrap'><a href="#" onclick="<?php //echo $url;?>" > <?php echo $row->voucher_id;?> </a></td>
                    <td align='left' class='fields_r' style='border-style: none;' nowrap='nowrap'><?php echo $row->code1;?></td>
                    <td align='left' class='fields_r' style='border-style: none;' nowrap='nowrap'><?php echo $row->code2;?></td>
                    
                    <td align='left' class='fields_r' style="border-style: none;" ><?php echo $row->customer_name;?></td>
                    <td align='left' class='fields_r' style='border-style: none;' nowrap='nowrap'><?php echo $row->branch_issued;?></td>
                    <td align='left' class='fields_r' style='border-style: none;' nowrap='nowrap'><?php echo $row->city;?></td>
                    
                    <td align='left' class='fields_r' style='border-style: none;' nowrap='nowrap'><?php if(!empty($row->home)) echo $row->home; else  echo $row->mobile;?></td>
                    
                    <td align='left' class='fields_r' style='border-style: none;' nowrap='nowrap'><?php echo $row->issued_date;?></td>
                    <td align='center' class='fields_r' > <input type="checkbox" name="selected_id_<?php echo $colorCounter;?>" id="selected_id_<?php echo $colorCounter;?>" value="<?php echo $row->voucher_id;?>" <?php if($row->taken_gift == '1') echo "checked"; ?> disabled="disabled" /> <?php //echo $row->taken_gift; ?></td>
                  </tr>
                                                     
                  <?php 
                  $colorCounter++;
                  }
                  }?>
			</table>
			<input type="hidden" id=count value="<?php echo $colorCounter;?>" />