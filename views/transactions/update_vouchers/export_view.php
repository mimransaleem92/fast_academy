			<?php 
			
			header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
			header('Content-Disposition: attachment; filename='.$file_name.'.xls');
			/*
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=extraction.csv");
			header("Pragma: no-cache");
			header("Expires: 0");
			
			//header('Content-Type: text/csv; charset=utf-8');
			//header('Content-Disposition: attachment; filename=data.csv');
			// create a file pointer connected to the output stream
			//fputcsv($output, array('Voucher', 'Code1', 'Code2', 'Customer Name', 'Branch', 'City'));
			
			$data = "Voucher, Code1, Code2, Customer Name, Branch, City \n";
			
			foreach($request_list as $row){
				echo $data =  $row->voucher_id . ",". $row->code1 . ",". $row->code2 . ",". $row->customer_name . ",". $row->branch . "," . $row->city;
				//fputcsv($output, $row);
			}*/ 
			//$output = fclose($file_name);
			
			?>
			<table id="form_tbl" width="90%" border="1" cellpadding="0" cellspacing="0" style="margin-top:2px; border:1px solid #000;">
              <tr style="height: 25px; font-weight:bold;" >
                    <td colspan="5" align="left" >Batch: <?php if($_GET['batch_no'] == '') echo 'ALL'; else echo $_GET['batch_no'];?></td>
                    <td colspan="2" align="right" >Created Date: <?php echo date('d M, Y H:i:s');?></td>
             </tr>
              <tr style="height: 25px; font-weight:bold;" >
                    <td align="center">Sr</td>
                    <td align="left" width="120px" style="padding:4px;">Voucher</td>
                    <td align="left" nowrap="nowrap" >Code 1</td>
                    <td align="left" nowrap="nowrap" >Code 2</td>
                    <td align="left" nowrap="nowrap" >Customer Name</td>
                    <td align="left" nowrap="nowrap" >Branch</td>
                    <td align="left" >City</td>
                    <!-- 
                    <td align="left" nowrap="nowrap" >Date</td>
                    <td align="center" nowrap="nowrap" >Status</td> -->
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
                  <tr style="height: 25px;" >	
                    <td align="center"><?php echo $count;?></td>
                    <td align='left' style="padding-left:4px;" nowrap='nowrap'> <?php echo $row->voucher_id;?></td>
                    <td align='left' nowrap='nowrap'><?php echo $row->code1;?></td>
                    <td align='left' nowrap='nowrap'><?php echo $row->code2;?></td>
                    
                    <td align='left' ><?php echo $row->customer_name;?></td>
                    <td align='left' nowrap='nowrap'><?php echo $row->branch;?></td>
                    <td align='left' nowrap='nowrap'><?php echo $row->city;?></td>
                    <!-- 
                    <td align='left' style='border-style: none;' nowrap='nowrap'><?php echo $row->update_date;?></td>
                    <td align='center' > <input type="checkbox" name="selected_id_<?php echo $colorCounter;?>" id="selected_id_<?php echo $colorCounter;?>" value="<?php echo $row->voucher_id;?>" <?php if($row->taken_gift == '1') echo "selected";?> /></td> -->
                  </tr>
                                                     
                  <?php 
                  $colorCounter++;
                  }
                  }?>
			</table>
			<input type="hidden" id=count value="<?php echo $colorCounter;?>" />