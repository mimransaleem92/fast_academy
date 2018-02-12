<?php

class Util {
	
	const _rowColor     = '#CFD7FF';
	const _rowTextColor = '#000000';
	const _per_page = 45;
	
	function convert_arabic($num_string){
		$numerial_no = array("0","1","2","3","4","5","6","7","8","9","-");
		$arabic_no = array("۰","۱","۲","۳","٤","۵","٦","۷","۸","۹","/");
		$num_string = str_replace($numerial_no , $arabic_no , $num_string);
		 
		return $num_string;
	}
	
	function num($val, $lang=NULL){
		if($lang==NULL) return $val;
		
		return Util::convert_arabic($val);
	}
	
	function final_gpa($marks){
		//=LOOKUP(H219,{0,60,63,66,69,73,76,79,83,86,89,93},{0,0.7,1,1.3,1.7,2,2.3,2.7,3,3.3,3.7,4})
		//=LOOKUP(H220,{0,60,63,66,69,73,76,79,83,86,89,93,96},{"F","D-","D","D+","C-","C","C+","B-","B","B+","A-","A","A+"})
		if($marks > 93) $gpa = '4';
		elseif($marks > 89) $gpa = '3.7';
		elseif($marks > 86) $gpa = '3.3';
		elseif($marks > 83) $gpa = '3.0';
		elseif($marks > 79) $gpa = '2.7';
		elseif($marks > 79) $gpa = '2.3';
		elseif($marks > 73) $gpa = '2.0';
		elseif($marks > 69) $gpa = '1.7';
		elseif($marks > 66) $gpa = '1.3';
		elseif($marks > 63) $gpa = '1.0';
		elseif($marks > 60) $gpa = '0.7';
		else $gpa = '0';
		
		return number_format($gpa, 1);
	}
	
	function final_grade($marks){
		
		//=LOOKUP(H220,{0,60,63,66,69,73,76,79,83,86,89,93,96},{"F","D-","D","D+","C-","C","C+","B-","B","B+","A-","A","A+"})
		if($marks > 96) $gpa = 'A+';
		elseif($marks > 93) $gpa = 'A';
		elseif($marks > 89) $gpa = 'A-';
		elseif($marks > 86) $gpa = 'B+';
		elseif($marks > 83) $gpa = 'B';
		elseif($marks > 79) $gpa = 'B-';
		elseif($marks > 76) $gpa = 'C+';
		elseif($marks > 73) $gpa = 'C';
		elseif($marks > 69) $gpa = 'C-';
		elseif($marks > 66) $gpa = 'D+';
		elseif($marks > 63) $gpa = 'D';
		elseif($marks > 60) $gpa = 'D-';
		else $gpa = 'F';
	
		return $gpa;
	}
	
	function gpa($marks){
		//=LOOKUP(J23,{0,30,33,36,39,42,45,48},{0,2,2.33,2.67,3,3.33,3.67,4})
		if($marks > 97) $gpa = '4';
		elseif($marks > 89) $gpa = '3.50';
		elseif($marks > 84) $gpa = '3.00';
		elseif($marks > 79) $gpa = '2.50';
		elseif($marks > 72) $gpa = '2.00';
		elseif($marks > 64) $gpa = '1.50';
		elseif($marks > 40) $gpa = '1.00';
		else $gpa = '0';
		
		return number_format($gpa, 2);
	}
	
	function get_grade($marks){
		//=LOOKUP(J23,{0,30,33,36,39,42,45,48},{"F","D+","C","C+","B","B+","A","A+"})
		if($marks > 97) $gpa = 'A+';
		elseif($marks > 89) $gpa = 'A';
		elseif($marks > 84) $gpa = 'B+';
		elseif($marks > 79) $gpa = 'B';
		elseif($marks > 72) $gpa = 'C+';
		elseif($marks > 64) $gpa = 'C';
		elseif($marks > 49) $gpa = 'D';
		else $gpa = 'F';
	
		return $gpa;
	}
	
	function email($to, $subject, $body) {
		$from = 'ejaz@scrailway.net';
		$headers = "From: $from\n";
		$headers .= "Content-Type: text/html\n";	
		//echo $subject;
		//echo $body;	
		if(mail($to, $subject, $body, $headers))
		{
			echo "Email sent successfully";
		}  
	}
	
	function assignEFrom($to, $emp_name,$type,$ref) {
		$to = $to;		
		$subject=$type." (".$ref.") from ".$emp_name. " ";
		$body = "Dear Sir, ";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "You have a request of ".$type." (".$ref.") for Approve/Reject. ";
		$body .= "Click <a href='http://10.153.76.11/idesk/dashboard' > here </a> to visit E-Form home page";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "Remarks: This is system generated email, so don't reply";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "Regards,";
		
		Util::email($to, $subject, $body);  
	}
	
	function approveRejectEmail($to, $type,$ref,$st) {
		
		$subject="Your ".$type." (".$ref.") ".$st;
		$body = "";
		$body .= "Your ".$type." (".$ref.") have been ".$st;
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "Remarks: This is system generated email, so don't reply";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "Regards,";		
		
		
		Util::email($to, $subject, $body);  
	}

	function assignSalaryPreparedEFrom($to, $emp_name,$t,$ref,$e,$leave_ref_number){
		$to = $to;		
		$subject=$t." (".$ref.") from ".$emp_name. " ";
		$body  = "<br />";
		$body .= "Mr. ".$emp_name." sent a request to prepare the ".$t."(".$ref.") for ".$e->emp_name." (".$e->or_num.") against Annual Leave Form (".$leave_ref_number.").";
		$body .= "<br /> Please process salary.";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "Remarks: This is system generated email, so don't reply";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "Regards,";
		
		Util::email($to, $subject, $body);  
	}
	
	function generateFormRefNumber($employee_id, $country_id, $comp_id='0', $div='0', $design='0') {
		// Nationalty-Company-Div-Position-Staff Number
		$id = Util::leading_zeros($employee_id, 4);
		$country_id    = Util::leading_zeros($country_id, 2);
		$div    = Util::leading_zeros($div, 2);
		$design = Util::leading_zeros($design, 2);
		
		$ref = $country_id."-".$comp_id."-".$div."-".$design."-".$id;
		
		return $ref;
	}
	
	function getVoucherReference($account_type, $reference_id){
		$id = Util::leading_zeros($reference_id, 6);
		$type = '';
		if($account_type == 'Bank Payment'){
			$type = 'BP';
		}
		elseif($account_type == 'Bank Receipt'){
			$type = 'BR';
		}
		elseif($account_type == 'Cash Payment'){
			$type = 'CP';
		}
		elseif($account_type == 'Cash Receipt'){
			$type = 'CR';
		}
		elseif($account_type == 'Purchase Voucher'){
			$type = 'PV';
		}
		
		$ref = $type.$id;
		
		return $ref;
	}
	
	function newTicketNotification($to, $emp_name="", $ref=""){
		$to = $to;
		$subject="New Ticket";
		$body  = "<br />";
		$body .= "Dear $emp_name,";
		$body .= "<br /> This message is to confirm that we have received your request and have opened a ticket for your issue.";
		$body .= "<br /> Please take care to mention the ticket number in any further mail.";
		$body .= "<br /> This message has been generated automatically, please do not reply to this email.";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
	
		Util::email($to, $subject, $body);
	}

	function assignTicket($to, $emp_name,$type,$ref) {
		$to = $to;
		$subject="Ticket (".$ref.") from ".$emp_name. " ";
		$body = "Dear Sir, ";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "A ticket has been assigned to you. ";
		$body .= "Click <a href='http://10.153.76.11/service_desk/status_screen' > here </a> to visit Service Desk status screen";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "Remarks: This is system generated email, so don't reply";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "Regards,";
	
		Util::email($to, $subject, $body);
	}
	
	function ticketResolvedNotification($to, $emp_name="", $ref=""){
		$to = $to;
		$subject="Ticket Resolved";
		$body  = "<br />";
		$body .= "Hello,";
		$body .= "<br /> Your ticket $ref has been resolved by VWS Saudi IT support.";
		$body .= "<br /> And you can reopen this ticket within 24 hours, if you are facing same issue.";
		$body .= "<br /> This message has been generated automatically, please do not reply to this email.";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
	
		Util::email($to, $subject, $body);
	}
	
	function ticketClosedNotification($to, $emp_name="", $ref=""){
		$to = $to;
		$subject="Ticket Closed";
		$body  = "<br />";
		$body .= "Hello,";
		$body .= "<br /> Your ticket $ref has been closed by VWS Saudi IT support.";
		$body .= "<br /> This message has been generated automatically, please do not reply to this email.";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
	
		Util::email($to, $subject, $body);
	}
	
	function ticketReopen($to, $emp_name="", $ref=""){
	
		$subject="Ticket Reopened";
		$body  = "<br />";
		$body .= "Hello,";
		$body .= "<br /> A ticket $ref has been reopened by Requester.";
		$body .= "<br />";
		$body .= "<br /> This message has been generated automatically, please do not reply to this email.";
		$body .= "<br />";
		$body .= "<br />";
		$body .= "<br />";
	
		Util::email($to, $subject, $body);
	}

  	function leading_zeros($value, $places){
		// Function written by Marcus L. Griswold (vujsa)
		// Can be found at http://www.handyphp.com
		// Do not remove this header!
	
  	 	$leading="";
	    if(is_numeric($value)){
	        for($x = 1; $x <= $places; $x++){
	            $ceiling = pow(10, $x);
	            if($value < $ceiling){
	                $zeros = $places - $x;
	                for($y = 1; $y <= $zeros; $y++){
	                    $leading .= "0";
	                }
	            $x = $places + 1;
	            }
	        }
	        $output = $leading . $value;
	    }
	    else{
	        $output = $value;
	    }
	    return $output;
	}
	
	function dateSavingFormat($dt)
	{
		if(!empty($dt)){
			$dt = explode('-', $dt);
		  	return $dt[2].'-'.$dt[1].'-'.$dt[0];
		}
	}
	 
	function displayFormat($dt){
		return Util::dateDisplayFormate($dt);
	}
	
	function dateDisplayFormate($dt)
	{
		if(!empty($dt) && !is_null($dt) && $dt != '0000-00-00')
		{
			$dt = explode("-",$dt);
			return $dt[2].'-'.$dt[1].'-'.$dt[0];
		}
	}
	 
	function dateDisplayFormateWithTime($dt)
	 {
	 	$t = explode(" ",$dt);
	 	$ti = "";
	 	if(isset($t[1])){
	 		$ti = $t[1];
	 	}
	 	return substr($dt,8,2).'-'.substr($dt,5,2).'-'.substr($dt,0,4)." ".$ti;
	 }
	 
	 function account_format($num, $d=2){
	 	if($num < 0){
	 		$num = (-1)*$num;
	 		return '('.number_format($num).')';
	 	}
	 	return number_format($num);
	 }
	  
	 function getCurrentPosition($h){
	 	$cur_emp_num  = $_SESSION['emp_num'];
	 	$cur_emp_role = $_SESSION['type'];
		$position = -1;
	 	for($i=0;$i<sizeof($h);$i++){			
			if($h[$i] == $cur_emp_num){
				$position = $i;
				break;
			}
	 		if($cur_emp_role == 3 && is_null($h[$i])){
				$position = $i;
				break;
			}
		}
		return $position;
	 }
	 
	 function skipHierarchy($res,$h,$level,$isBack, $ownerId){
	 	 
	 	 $in = $level;
	 	 $cur_emp_num = $this->session->userdata(SESSION_CONST_PRE.'userId');
		 for($i=$in;$i<sizeof($h);$i++){			
				if($i+1!=sizeof($h)){
					$next_emp_num = $res[$i+1];
					if($cur_emp_num == $next_emp_num){
						$level++;
						$cur_emp_num = $next_emp_num;
					}else if($ownerId == $next_emp_num){
						$level++;
						$cur_emp_num = $next_emp_num;
					}else{
						break;
					}
				}
			}		
			if($isBack){
				for($j=$level;$j<sizeof($h);$j++){
					if($j+1!=sizeof($h)){
						$next_emp_num = $res[$j+1];		
						$flag = false;
						
						for($i=$in-1;$i>=0;$i--){
							$pre_emp_num = $res[$i];
							
							if($pre_emp_num == $next_emp_num){
								$level++;
								$flag = true;
								break;										
							}
						}			
						if(!$flag){
							break;
						}
					}
				}
			}
	 	 return $level;
	 }
	 
	function skipHierarchyAlgo($model,$ownerId,$level,$h){	
		// skip hierarchy code
		$res = $model->getHierarchy($h, $ownerId);
		$cols = explode(", ", $h);
		return Util::skipHierarchy($res,$cols,$level,true,$ownerId);
	}
	
	function getItManagerEmpNum(){
    	return 11252;
    }
    
	function redirect($url){
			global $mainframe;			
			$mainframe->redirect($url);
	}
	
	function assignForm($to,$ownerId,$formId,$subType,$model){
		
		$e = $model->getEmployeeName($ownerId);
		$t = $subType;
		$ref = $model->getFormReference($formId);
		Util::assignEFrom($to, $e->emp_name,$t,$ref->ref_number);
	}
	function approveOrRejectForm($ownerId,$t,$formId,$model,$st){
		
		$e = $model->getEmployeeName($ownerId);
		$to = $e->email_id;
		$ref = $model->getFormReference($formId);
		Util::approveRejectEmail($to, $t,$ref->ref_number,$st);
	}
	
	
	function lastday($month = '', $year = '') {
	   if (empty($month)) {
	      $month = date('m');
	   }
	   if (empty($year)) {
	      $year = date('Y');
	   }
	   $result = strtotime("{$year}-{$month}-01");
	   $result = strtotime('-1 second', strtotime('+1 month', $result));
	   return date('d', $result);
	}
	
	function addNotification($model,$description){		
		$data = JRequest::get( 'post' );		
		$formId = $data['formId'];
		$ownerId = 	$data['ownerId'];
		$emp_num = $model->getAdminId($ownerId);
		$ref = $model->getFormReference($formId);
		$model->addNotificationLog($ref->ref_number,$emp_num->id,$description);
	}
	
	function view_date($dt){
		if(!empty($dt) && !is_null($dt) && $dt != '0000-00-00')
		return substr($dt,8,2).'-'.substr($dt,5,2).'-'.substr($dt,0,4);
	}
	
	function add_time($t1, $min){
		$time = explode(':', $t1);
		if(isset($time[1])){
			$m = $time[1] + $min;
			$h = $time[0];
			if($m >= 60){
				$m -= 60;
				$h++;
			}
			return $h.':'.$m;
		}
		return $t1;
	}
	
	function ageCalculator($dob){
		if(!empty($dob)){
			$birthdate = new DateTime($dob);
			$today   = new DateTime('today');
			$age = $birthdate->diff($today)->y;
			return $age;
		}else{
			return 0;
		}
	}
}


?>