		<form id="attendForm" method="post" >
			<table width="100%" height="300" border="0" cellspacing="0" cellpadding="0">
	            <tr>
	            	<td valign="top">
                  		<table width="670" border="0" cellspacing="3" cellpadding="2">
					    	<tr>
			                  	<td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Subject');?>:
					            </td>
			                  	<td width="170" align="<?php echo $class_left;?>" valign="middle">
				                  	<select name="subject_id" class="form-control" id="subject_id" onchange="onchange_subject(this.value)">
					                    <option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
					                    <?php foreach($subject_list as $sub){ 
					                    	$comp_id = $sub->subject_id.'-'.$sub->period_per_week;
					                    	?> 
					                    	<option value="<?php echo $comp_id;?>" ><?php echo $sub->subject_name;?></option>
					                    <?php } ?>
									</select>
			                  	</td>
			                  	<td width="*" align="<?php echo $class_left;?>" valign="middle"><span id="span_detail"></span></td>
			                </tr>
				            <tr>
			                  	<td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Teacher');?>:</td>
			                  	<td width="170" align="<?php echo $class_left;?>" valign="middle" id="td_teacher" >
			                  		<select name="employee_id" class="form-control" id="employee_id" >
					                    <option value="0">---<?php echo Base_Controller::ToggleLang('SELECT'); ?>---</option>
									</select>
								</td>
			                  	<td width="*" align="<?php echo $class_left;?>" valign="middle"></td>
			                </tr> 
			                <tr>
			                  	<td width="86" align="<?php echo $class_left;?>"><?php echo Base_Controller::ToggleLang('Week Days');?>:</td>
			                  	<td width="170" align="<?php echo $class_left;?>" valign="middle" id="td_teacher" >
			                  		<input type="radio" name="weekdays_type" id="weekdays_all" value="ALL"> All &nbsp;
			                  		<input type="radio" name="weekdays_type" id="weekdays_selected" value="SELECTED" checked="checked"> Selected 
								</td>
			                  	<td width="*" align="<?php echo $class_left;?>" valign="middle"></td>
			                </tr>      
			            </table>
			            <?php $arr = explode('-', $_GET['class_id']); ?>
			            <input type="hidden" name="course_id" id="course_id" value="<?php echo $arr[0];?>"/>
			            <input type="hidden" name="batch_id" id="batch_id" value="<?php echo $arr[1];?>"/>
			            <input type="hidden" name="id" id="id" value="<?php echo $arr[2];?>"/>
			            <input type="hidden" name="weekday" id="weekday" value="<?php echo $_GET['weekday'];?>"/>
			            
			    	</td>
            	</tr>
            </table>
           </form>