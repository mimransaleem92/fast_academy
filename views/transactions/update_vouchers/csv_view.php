			<?php 
			
			header('Content-Encoding: UTF-8');
			header('Content-type: text/csv; charset=UTF-8');
			header('Content-Disposition: attachment; filename='.$file_name.'.csv');
			echo "\xEF\xBB\xBF"; // UTF-8 BOM
						
			echo $data = "Voucher, Code1, Code2, Customer Name, Branch, City \n";
			
			foreach($request_list as $row){
				echo $data =  $row->voucher_id . ", ". $row->code1 . ", ". $row->code2 . ", ". $row->customer_name . ", ". $row->branch . ", " . $row->city;
				//fputcsv($output, $row);
			}
			?>
			