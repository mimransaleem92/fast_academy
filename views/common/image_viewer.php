<style type="text/css">

            .reqFormsubHead {
			    background: none repeat scroll 0 0 #BBD9F6;
			    border-bottom: 1px solid #8CBAE8;
			    padding: 4px;
			    font-weight: bold;
			}
	</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
	              <tr>
	                <td valign="top" style='font: bold 14px "verdana", Arial, Verdana, Helvetica, sans-serif'>
		            <table width="100%" border="0" cellpadding="0" cellspacing="0"  style="margin-top:2px; border:1px solid #8CBAE8;">
		                 <tr class="reqFormsubHead">
					         	<td height="30" nowrap="nowrap" align="left" class="bluebar_bottom" style="border-style: none; font-weight: bold;font-style: bold;">
					         	:: <?php echo $this->session->userdata(SESSION_CONST_PRE.'app_title');?></td>
			             </tr>
		             	
			             <tr>
			             	<td height="320" valign="middle" align="center">
							<?php if($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' ){?>
								<img alt="" src="<?php echo base_url().'assets/uploads/'.$file_name;?>">
							<?php }else{?>
								Click to download: <a href="<?php echo base_url().'assets/uploads/'.$file_name;?>" > <?php echo $file;?></a>
							<?php }?>
							</td>
			             </tr>
			        </table>
					</td>
	              </tr>
</table>