<script type="text/javascript">
<!--
function onclick_row(count){
	var obj = document.getElementById('selected_id_'+count);
	if(obj.checked){
		obj.checked = false;
	}
	else
	{
		obj.checked = true;
	}
}

function onchange_search_by(val)
{
	document.getElementById('search').value = '';
	document.getElementById('search').focus();	
}
function get_search(e){
	var search_by = document.getElementById('search_by').value;
	var search = document.getElementById('search').value;
	
	parms = 'search_by='+search_by+'&search='+search;
	var key = window.event ? window.event.keyCode : e.which;
	//get('users/search', '', 'result_tbl', false,'frmSearch');
	
	if(key == '0' || key == '1' || key == '13'){
		get('user/search', '', 'result_tbl', false,'frmSearch');
	}
}

function showSearchBar(){
	document.getElementById('search_tbl').style.display = 'block';
}

//-->
</script>
					
					<form id=frmSearch onsubmit="return false;">
						<input type="submit" style="display:none" onclick="return false;" id=btnSubmit value="search" />
					<table id=search_tbl width="99%" border="0" cellspacing="0" cellpadding="4" style="cursor:pointer; ">
                        <tr>
                        	<td width="100px" class="frame_blue">Search by:</td>
                        	<td width="210px" class="frame_blue">
                        		<select id="search_by" name="search_by" class="field_big" onchange="onchange_search_by(this.value);">
                        			<option value="u.name">Name</option>
                        			<option value="u.user_id" selected="selected">P/No</option>
                        			
                        		</select>
                        	</td>
                        	<td width="210px" class="frame_blue">
                        		<input type="text" name="search" id="search" class="field_big" value="" onkeyup="return get_search(event);"/>
                        	</td>
                        	<td width="*" class="frame_blue"><input type="button" id="btn_search" style="width:80px" class="field_big" value="Go" onkeyup="return get_search(event);" onclick="return get_search(event);"/></td>
                        	
                        </tr>
                    </table></form>
                    	
                    <br/>
                    <span id="result_tbl">
					<table width="99%" border="0" cellspacing="0" cellpadding="0" style="cursor:pointer">
                        <tr>
                            <td width="4%" class="frame_blue"><label></label></td>
                            <td width="4%" class="frame_blue"><?php echo Base_Controller::ToggleLang('P/No');?></td>
                            <td width="*" class="frame_blue"><?php echo Base_Controller::ToggleLang('Name');?></td>
                            <td width="15%" class="frame_blue"><?php echo Base_Controller::ToggleLang('Role');?></td>
                            <td width="10%" class="frame_blue"><?php echo Base_Controller::ToggleLang('Is Active');?></td>
                          </tr>
                  		<?php 
                          if(isset($user_list) && sizeof($user_list) > 0){
                          	$i=0;
                          	foreach($user_list as $values){
                          		$i++;
                          		$class = "frame_blue_light";
                          		if($i%2==0){
                          			$class = "frame_blue_dark";
                          		}
                          ?>
	                          <tr>
	                            <td class="<?php echo $class; ?>"><input type="checkbox" name="selected_id_<?php echo $i;?>" id="selected_id_<?php echo $i;?>" value="<?php echo $values->user_id;?>" /></td>
	                            <td onclick="onclick_row('<?php echo $i;?>');" class="<?php echo $class; ?>" style="color:#888888;"><strong><?php echo $values->user_id; ?></strong></td>
	                            <td onclick="onclick_row('<?php echo $i;?>');" class="<?php echo $class; ?>"><?php echo $values->name?></td>
	                            <td onclick="onclick_row('<?php echo $i;?>');" class="<?php echo $class; ?>"><?php echo $values->role_name;?></td>	                          
	                            <td onclick="onclick_row('<?php echo $i;?>');" class="<?php echo $class; ?>">
	                            <?php $is_active = $values->is_active;
	                            if($is_active == 1)
	                            {
	                            	echo Base_Controller::ToggleLang('Yes');
	                            }
	                            else {
	                            	echo Base_Controller::ToggleLang('No');
	                            }
	                            ?></td>
	                          </tr>
	                  <?php 	}
                          }
                          	?>
	                </table>
	                <input type="hidden" id="count" value="<?php echo $i;?>"/>
	                <ul id="pagination-digg" class="ajax-pag"><?php if (isset($links)) echo $links;?></ul>
	                </span>