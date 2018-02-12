<?php
	if($action == $model) {  include ''.$model.'_index.php'; }
	else {
      include ''.$model.'_'.$action.'.php';
	}
?>