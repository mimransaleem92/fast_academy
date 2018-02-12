							<tr> 
	                            <td colspan="7" ><span style="float: left;"></span>
	                            <span style="float: right;padding-right: 3px"><?php echo '<b>Date:</b> '.date('d-m-Y H:i:s');?></span></td>
                          	</tr>
                          	<tr>
	                            <td colspan="7" align="left" style="padding-left: 3px">
	                            <?php echo $search_param;?></td>
	                            
                          	</tr>
                          	<?php if(isset($from)){?>
                          	<tr style="<?php  if(in_array($model, array('fee_history', 'paid_students'))) { echo 'display:none'; } ?>">
	                            <td id='line1' colspan="7" align="left" style="padding-left: 3px; text-decoration: underline;"><?php echo '<b>From:</b> '.Util::dateDisplayFormate($from).'&nbsp;&nbsp;&nbsp; <b>To:</b>'.Util::dateDisplayFormate($to);?></td>
	                            
                          	</tr>
                          	<?php }
                          	
                          	if(isset($_POST['course_id']) || isset($_POST['section']) || isset($_POST['payment_mode']) || isset($_POST['fee_desc'])){?>
                          	<tr>
	                            <td id='line2' colspan="7" align="left" style="padding-left: 3px; text-decoration: underline;">
	                            
	                            <?php 
		                            if(isset($_POST['course_id']) && $_POST['course_id'] != '' && $_POST['course_id_to'] != ''){
		                            	if($_POST['course_id'] != $_POST['course_id_to']){ 
		                            		echo '<b>'. Base_Controller::ToggleLang('course').': </b>'. $courses[$_POST['course_id']]. ' to ' . $courses[$_POST['course_id_to']] .'&nbsp;&nbsp;&nbsp;';
		                            	}
		                            	else{
		                            		echo '<b>'. Base_Controller::ToggleLang('course').': </b>'. $courses[$_POST['course_id']].'&nbsp;&nbsp;&nbsp;';
		                            	}	
		                            }
		                                
		                            if(isset($_POST['section']) && $_POST['section'] != '')  echo '<b>'. Base_Controller::ToggleLang('Section').': </b>'. $_POST['section'] .'&nbsp;&nbsp;&nbsp;';
		                            if(isset($_POST['subject_id']) && $_POST['subject_id'] != '')  echo '<b>'. Base_Controller::ToggleLang('subject').': </b> ' .  $subjects[$_POST['subject_id']] .'&nbsp;&nbsp;&nbsp;';
									if(isset($_POST['payment_mode']) && $_POST['payment_mode'] != '') echo '<b>'. Base_Controller::ToggleLang('Payment Mode').': </b>'. $_POST['payment_mode'].'&nbsp;&nbsp;&nbsp;' ;
		                            if(isset($_POST['fee_desc']) && $_POST['fee_desc'] != '') echo '<b>'. Base_Controller::ToggleLang('Fee Type').': </b>'. $_POST['fee_desc'].'&nbsp;&nbsp;&nbsp;' ;
		                            if(isset($_POST['batch_id']) && $_POST['batch_id'] != '') echo '<b>'. Base_Controller::ToggleLang('Session').': </b>'. $batch_name ;
		                            if(isset($_POST['division_id']) && $_POST['division_id'] != ''){ 
		                            	if($_POST['division_id'] == '1'){
			                            	echo '<b>'. Base_Controller::ToggleLang('Division').': </b>DNS' ;
			                            }else{
			                            	echo '<b>'. Base_Controller::ToggleLang('Division').': </b>DIS' ;
			                            }
		                            }
	                            ?>
	                            
	                            </td>
                          	</tr>
                          	<?php }
                          	
                          	if(isset($_GET['course_id']) || isset($_GET['section']) || isset($_GET['payment_mode']) || isset($_GET['fee_desc'])){?>
                          	<tr>
	                            <td id='line3' colspan="7" align="left" style="padding-left: 3px; text-decoration: underline;">
	                            
	                            <?php
		                            if(isset($_GET['course_id']) && $_GET['course_id'] != '' && $_GET['course_id_to'] != ''){
		                            	if($_GET['course_id'] != $_GET['course_id_to']){
		                            		echo '<b>'. Base_Controller::ToggleLang('course').': </b>'. $courses[$_GET['course_id']]. ' to ' . $courses[$_GET['course_id_to']] .'&nbsp;&nbsp;&nbsp;';
		                            	}
		                            	else{
		                            		echo '<b>'. Base_Controller::ToggleLang('course').': </b>'. $courses[$_GET['course_id']].'&nbsp;&nbsp;&nbsp;';
		                            	}
		                            } 
		                            if(isset($_GET['section']) && $_GET['section'] != '')  echo '<b>'. Base_Controller::ToggleLang('Section').': </b>'. $_GET['section'] .'&nbsp;&nbsp;&nbsp;';
		                            if(isset($_GET['payment_mode']) && $_GET['payment_mode'] != '') echo '<b>'. Base_Controller::ToggleLang('Payment Mode').': </b>'. $_GET['payment_mode'].'&nbsp;&nbsp;&nbsp;';
		                            if(isset($_GET['fee_desc']) && $_GET['fee_desc'] != '') echo '<b>'. Base_Controller::ToggleLang('Fee Type').': </b>'. $_GET['fee_desc'].'&nbsp;&nbsp;&nbsp;';
		                            if(isset($_GET['batch_id']) && $_GET['batch_id'] != '') echo '<b>'. Base_Controller::ToggleLang('Session').': </b>'. $batch_name ;
		                            if(isset($_GET['division_id']) && $_GET['division_id'] != ''){
		                            	if($_GET['division_id'] == '1'){
		                            		echo '<b>'. Base_Controller::ToggleLang('Division').': </b>DNS' ;
		                            	}else{
		                            		echo '<b>'. Base_Controller::ToggleLang('Division').': </b>DIS' ;
		                            	}
		                            }
	                            ?>
	                            
	                            </td>
                          	</tr>
                          	<?php }
                          	if(isset($_GET['subject_id'])){?>
                          	<tr>
	                            <td id='line4' colspan="7" align="left" style="padding-left: 3px; text-decoration: underline;">
	                            <?php
		                            if(isset($subjects[$_GET['subject_id']]))
		                            {
		                            	echo '<b>'. Base_Controller::ToggleLang('subject').': </b> ' .  $subjects[$_GET['subject_id']] ;
		                            }
	                            ?>
	                            </td>
                          	</tr>
                          	<?php }
                          	if(isset($_GET['account_id']) || isset($_POST['account_id'])){?>
                          	<tr>
	                            <td id='line4' colspan="7" align="left" style="padding-left: 3px; text-decoration: underline;">
	                            <?php
		                            //if((isset($_GET['account_id']) && $_GET['account_id'] != '') || (isset($_POST['account_id']) && $_POST['account_id'] != ''))
		                            if(isset($account_name))
		                            {
		                            	echo '<b>'. Base_Controller::ToggleLang('ledger_ac').': </b> ' .  $account_name ;
		                            }
	                            ?>
	                            
	                            </td>
                          	</tr>
                          	<?php }?>
