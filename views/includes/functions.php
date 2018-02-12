<?php

require_once APPPATH.'config/config.php';

		function getStatus($status_id) {
			$app_status = Config::getAppStatus();
		  	if ($status_id -1 < 0){
			 return $app_status[0];
		  	}
			return $app_status[$status_id-1];
		}
		
		function getNextStep($status_id, $admin=false) {
		  	$app_next = Config::getAppNextStep();
		  	
			if ($status_id -1 < 0)
				$next_step = $app_next[0];
			else
				$next_step = $app_next[$status_id-1];
			
			return $next_step;
		}
		
		function getConfigureAppDo($status_id) {
			$app_status = Config::getConfigureAppDoArray();
		  	if ($status_id -1 < 0){
			 return $app_status[0];
		  	}
			return $app_status[$status_id-1];
		}
		
		function snSelect($result,$snid) {
//			global $conn; mysql_select_db($GLOBALS['db_name'], $conn);
//			$result = ConfigureMO::getSnForSelection($merchant_id);
//			$sql = "select snid, lcase, ucase from sn WHERE open_web = 0 OR (open_web = 1 AND merchant_id='$merchant_id')";
//			$result = mysql_query($sql, $conn);
			if ($result) {
				$num = sizeof($result);
				if ($num != 0) {
					echo "<tr>";
					echo "<td nowrap align='right'><span class='right'>Social Network</span></td><td align='left'>";
					echo "<select name='snid'>";
					$selected = false; 
					foreach($result as $key => $sn){
//					while($row = mysql_fetch_array( $result )) {
						$selected_state = '';
						if (strcmp($snid, $sn->getSnId()) == 0) {
							$selected_state = "selected"; 
							$selected = true;
						}
						echo "<option value='".$sn->getSnId()."' $selected_state>".$sn->getUcase()."</option>";
					}
					if (!$selected) {
						$selected_state = "selected";
					}else{
						$selected_state = '';
					}
					echo "<option value='Website' $selected_state>Website</option>"; 
					echo "</select>";
					echo "</td></tr>";
				}
			}
		}
		
		function snLcase($snid) {
			return $snid;
		}
		
		function number_pad($number,$n) {
		return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
		}
		
		require_once('assets/php/localization.php');
		//echo $lang;
		/*
		function ToggleLang($label){
			$l = 'ar';
			if(isset($_COOKIE['hrm_lang'])){
				//echo $_COOKIE['hrm_lang'];
				if($_COOKIE['hrm_lang'] == 'en'){
					$l = 'en';
				}
			}
			//$tmx  = new Localization('assets/php/localize.xml',  $l); // english
			//$traslate = $tmx->getResource();
			
			$label = trim($label);
			$label_ar = str_replace(' ', '_', strtolower($label));
			if(isset($traslate[$label_ar]))
			{
				$label = $traslate[$label_ar];
			}
			return $label;
		}
		*/
		function view_date($dt){		
			return substr($dt,8,2).'-'.substr($dt,5,2).'-'.substr($dt,0,4);
		}
		
?>