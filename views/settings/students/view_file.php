<link rel="stylesheet" href="<?php echo base_url();?>assets/global/plugins/flipclock/compiled/flipclock.css">
<script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/flipclock/compiled/flipclock.js"></script>
<?php

?>
<style>
<!--
#container {
  width: 100%;
  height: 100%;
  position: relative;
}

#navi, #infoi {
  
  position: absolute;
  top: 0;
  left: 0;
}

#infoi {
  width: 100%;
  height: 100%;
  background-color:green;	
  z-index: 10;
}
#navi {
  width: 25%;
  height: 100px;
  top: 0;
  left: 75%;
  z-index: 99;
}
-->
</style>
<div id="container">

  <!-- <div id="navi"  >
	<div class="clock" style="float:right;"></div>
	<div class="message"></div>
  </div> -->
  <div id="infoi">
  <?php $url = "assets/global/img/uploads/lecture_files/".$_GET['f'];
  $seach_string =  ((true)? 'C:/wamp/www'.base_url() : 'http://schools.webserve.com.sa/delta/') ; 
  //$url = $file->file_path;
  $file_type = substr($file->file_ext, 1);
  $url = str_replace($seach_string, '../../',$file->full_path);
  
  if($file_type == 'pdf'){
  	echo '<embed src="'.$url.'" width=100% height=100%>';
  	
  }else if($file->is_image == 1){
  	echo '<img src="'.$url.'" width=100% height=100% >';
  
  }else if(in_array($file_type, array('avi','mp4','ogg', 'webM','ogv'))){
  ?>
  <video controls="controls" width="100%" height="100%" >
  <source src="<?php echo $url;?>" type="video/<?php echo $file_type;?>">
  
  Your browser does not support HTML5 video.
  </video>
  <?php 
  }else{
  ?>
   <iframe src="http://docs.google.com/gview?url=<?php echo $url;?>&embedded=true" 
	style="width:100%; height:640px;" frameborder="0"></iframe>
  </div>
  <?php }?>
</div>	
<script type="text/javascript">
	/*var clock;

	$(document).ready(function() {

		// Instantiate a counter
		clock = new FlipClock($('.clock'), 30, {
			clockFace: 'MinuteCounter',
			autoStart: true,
			countdown: true,
			callbacks: {
	        	stop: function() {
	        		$('.message').html('The clock has stopped!');
	        	}
	        } 
		});
		
	});*/
</script>