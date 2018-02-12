<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
if ( ! class_exists('tfpdf')){
 require_once(BASEPATH.'libraries/tfpdf'.EXT);
}

$obj =& get_instance();
$obj->tfpdf = new tfpdf();
$obj->ci_is_loaded[] = 'tfpdf';
?>