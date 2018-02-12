<script type="text/javascript">
<!--
function onfocusRefNumber(obj){
	var val = obj.value;
	if(val == '-- Voucher Number --'){
		obj.value = '';
	}
}

function onblurRefNumber(obj){
	var val = obj.value;
	if(val == ''){
		obj.value = '-- Voucher Number --';
	}
}

function onclick_import(){
	var val = document.getElementById('upload_file').value;
	if(val.length < 5){
		document.getElementById('error_msg').innerHTML = "Please select a file to import!";
		return false;
	}
	else
	{
		return true;
	}	
}

function onclick_export(){
	var batch = document.getElementById('batch_no').value;
	window.open('vouchers/export_xls?batch_no='+batch, '_blank');
}

function get_search(e){
	var batch = document.getElementById('batch_no').value;
	var search = document.getElementById('txtRefNumber').value;
	var key = window.event ? window.event.keyCode : e.which;
	
	if(search != '-- Voucher Number --' && (key == '0' || key == '1' || key == '13')){
		document.getElementById('error_msg').innerHTML = "";
		get('vouchers/search', 'batch_no='+batch, 'result_tbl', false,'frmSearch');
	}
	else{
		document.getElementById('error_msg').innerHTML = "Please enter voucher number to search.";
	}
}
function onchange_batch(val){
	document.getElementById('error_msg').innerHTML = "";
	get('vouchers/search', 'batch_no='+val, 'result_tbl', false,'frmSearch');
}
//-->
</script>
		<form id=frmSearch method="post" action="<?php echo base_url();?>update_vouchers/upload_csv" enctype="multipart/form-data">
			<input type="submit" style="display:none" onclick="return false;" id=btnSubmit value="search" />
			<table  width="90%" border="0" cellpadding="0" cellspacing="0" >
              	
              	<tr style="height: 25px" >
              	
                    <td align="left" nowrap="nowrap" style="padding:4px;">
					    <span style="font-weight:bold;" >Quick Search: </span> 
					    <input type="text" id="txtRefNumber" name="txtRefNumber" style="text-align:center;" class="field_big" value="-- Voucher Number --" onfocus="onfocusRefNumber(this);" onblur="onblurRefNumber(this);" onkeyup="javascript: get_search(event);" />
                        &nbsp;
                        <input type="button" id="btn_ref_search" style="width:85px" class="field_big" value="Go" onclick="javascript: get_search(event);" />
                        &nbsp;
                        <span id="error_msg" class="required"></span>
					</td>
                    <td align="right" nowrap="nowrap" style="padding:4px;" >&nbsp;</td>
            	</tr>
            </table>
            
			<table id="form_tbl" width="90%" border="0" cellpadding="0" cellspacing="0" class="whitebgBorder" style="margin-top:2px; border:1px solid #8CBAE8;">
              	
              	<tr style="height: 25px" >
                    <td align="left" nowrap="nowrap" style="padding:4px;">
					    <input type="submit" id="btn_new" style="width:85px;" class="field_big" value="Import" onclick="return onclick_import();" />
                        &nbsp;
                        <input type="button" id="btnedit" style="width:85px" class="field_big" value="Export" onclick="onclick_export();"/>
                        &nbsp;
                        <input type="file" id="upload_file" name="upload_file" />
                   </td>
                   <td style="padding:4px;" width="130px">
                   		Batch: 
                   		<select name="batch_no" id="batch_no" class="select_big" style="width:85px" onchange="onchange_batch(this.value);">
	                   		<option value="" >--<?php echo Base_Controller::ToggleLang('All'); ?> --</option>
	                   		<?php 
	                   		foreach ($batch_list as $value) {
	                   			echo '<option selected>'.$value->batch_no.'</option>';
	                   		}
	                   		?>
                   		</select>
                   </td>
            	</tr>
            </table>
		</form>
			<br />
		<span id="result_tbl" >
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
		</span>
		