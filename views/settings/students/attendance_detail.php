<script type="text/javascript">
<!--
$(function() {
	$( document ).tooltip();
});
function setDate(dt){
	var _url = "<?php echo base_url().$model;?>/get_student_attendance";
	_url = _url + "?attendance_date=" + dt +"&student_id=<?php echo $student_id;?>";

	get(_url, '', 'div_attendance', false, '');
}
//-->
</script>
	<?php  
		 
		$day_name = array('S', 'M', 'T', 'W', 'Th', 'F', 'S');
	?>

		<div id="div_attendance">
			<div> 
				<table border="0">
					<tr align="center" style="cursor:pointer">
						<td style="font-weight:bold;size:2" onclick="setDate('')" ><img src="<?php echo base_url();?>assets/images/en/left_end.png" ></td>
						<td style="font-weight:bold;size:2" onclick="setDate('<?php echo $pre_date?>')" >&nbsp; <img src="<?php echo base_url();?>assets/images/en/left_niv.png" > &nbsp;</td>
						<td style="width:110px"><?php //echo $curr_date; ?> 
						<input type="text" id="attendance_date" value="<?php echo $curr_month.' '.$curr_year;?>" class="dateCss" onchange="setDate(this.value);" />
						</td>
						<td style="font-weight:bold;size:2" onclick="setDate('<?php echo $next_date?>');"  > &nbsp; <img src="<?php echo base_url();?>assets/images/en/right_niv.png" > &nbsp;</td>
						<td style="font-weight:bold;size:2" onclick="setDate('')"><img src="<?php echo base_url();?>assets/images/en/right_end.png" ></td>
					</tr>
				</table>
			</div>
				<div  id="tblAttendance" style="width: 800px; position:absolute;  overflow:auto;">
					<table border="1" style="border: 2px solid #000; width: 100%; background-color: #FFF; color: #000;">
		                <tr>
	                    	<?php $w = $week_day_start;
	                    		for($days=1; $days<=$total_days; $days++){ if($w==7) $w=0; ?>
	                    	<td width="33px" style="border-right:2px solid #000000; border-bottom:2px solid #000; padding:4px">
	                    	<span style="width:24px"><?php echo $day_name[$w];?></span><br>
	                    	<span style="width:24px"><?php echo $days;?></span>
	                    	</td>
	                    	
	                    	<?php $w++;}?>
	                	</tr>
	                	<tr>
	                    	<?php 
	                            $title = "Mark Attendance";
	                        	for($days=1; $days<=$total_days; $days++){
									$cell_id = $year_month.'-'.$days;
									$tooltip = "";
									$param = 'student_id='.$student_id."&attendance_date=".$cell_id;
									$url   = base_url().$model."/add_attend";
									$curr_app = '&nbsp;'; $i = $days;
									if($days < 10 ) $i = '0'.$days;
									if(isset($attendance[$i])){
										
										$tooltip = 'Reason: '.$attendance[$i];
										$curr_app = '<i class="fa fa-times"></i>';
									}
									
								echo '<td id="'.$cell_id.'" valign="top" style="padding:4px; border-right:2px solid #000000;" nowrap="nowrap" onclick="">'. $curr_app .'</td>';?>
	                    		
	                    	<?php }?>
	                	</tr>
	            	</table>
	    	</div>
		</div>