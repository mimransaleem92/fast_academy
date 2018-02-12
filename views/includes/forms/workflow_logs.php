<style type="text/css">
table.sample {
	border-width: 0px;
	border-spacing: 0px;
	border-style: none;
	border-color: black;
	border-collapse: collapse;
	background-color: white;
}
table.sample th {
	border-width: thin;
	padding: 2px;
	border-style: inset;
	border-color: black;
	background-color: white;
	-moz-border-radius: 0px 0px 0px 0px;
}
table.sample td {
	border-width: thin;
	padding: 2px;
	border-style: inset;
	border-color: black;
	background-color: white;
	-moz-border-radius: 0px 0px 0px 0px;
}
</style>
<?php if (!is_null($this->workflow_logs) && isset($this->workflow_logs[0])){?>
	
<span style="font:bold 16px Arial; cursor:pointer;" onclick="javascript: srcElement=document.getElementById('log_div'); if(srcElement.style.display == 'block'){srcElement.style.display= 'none';}else{srcElement.style.display= 'block';}">Workflow Logs:
&nbsp; 
<?php $sum_logs = "";		
		foreach($this->workflow_logs as $row){			                  		
			$sum_logs .= ucwords(strtolower($row->EMP_NAME))." / ";			
		}
		$sum_logs = substr($sum_logs,0,strlen($sum_logs)-2);
		?>
<span id="sum_logs" style="font:bold 11px Arial;"> <?php echo $sum_logs;?></span>
</span>
<br />
<div id="log_div" style="display:none" >
<table class="sample">
		<tr>
           <td height="30" nowrap="nowrap" align="left" style="font-weight: bold;font-style: bold;">Name</td>
           <td align="left" nowrap="nowrap" style="font-weight: bold;font-style: bold;">Form Submited Date</td>
           <td align="left" nowrap="nowrap" style=" font-weight: bold;font-style: bold;">Form Approval Date</td>
           <td align="left" nowrap="nowrap" style="font-weight: bold;font-style: bold;">Comments</td>
           
        </tr>
             
		<?php foreach($this->workflow_logs as $row){?>	
		<tr>
            <td align='left' nowrap='nowrap'><?php echo $row->EMP_NAME;?></td>
            <td align='left' nowrap='nowrap'><?php  echo Util::dateDisplayFormateWithTime($row->created_date);?></td>
            <td align="left"  nowrap='nowrap'><?php echo Util::dateDisplayFormateWithTime($row->updated_date);?></td>
            <td align='left'><?php echo $row->comments?></td>
            
       </tr>
		<?php }	?>	
</table>
</div>
<?php }?>