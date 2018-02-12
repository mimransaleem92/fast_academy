			<?php 
			header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
			header('Content-Disposition: attachment; filename='.$file_name.'.xls');
			header("Pragma: no-cache");
		    header("Expires: 0");
			
                  $header = 'Voucher' . "\t" . 'CRC1' . "\t". 'CRC2' . "\t";
                  $data = '';
                  if(sizeof($request_list) == 0){                  	
					$data = "\n(0) Records Found!\n";
                  }else{                  
	                  foreach($request_list as $row){			                  		
	                  	
		                    $line = '"' . $row->voucher_id . '"' . "\t";
		                    $line .= '"' . $row->code1 . '"' . "\t";
		                    $line .= '"' . $row->code2 . '"' . "\t";
		                    $data .= trim( $line ) . "\n";
	                  }
	                  $data = str_replace( "\r" , "" , $data );
                  }
		
		    //header("Content-type: application/octet-stream");
		   // header("Content-Disposition: attachment; filename=voucher_codes.xls");
		    
		    echo "\n$header";
		    echo "\n$data";			
			?>