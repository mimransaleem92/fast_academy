<script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
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
  
  <div id="infoi">
  <?php
  $seach_string =  ((true)? 'C:/wamp/www'.base_url() : 'http://schools.webserve.com.sa/delta/') ; 
   
  $file_type = substr($file->file_ext, 1);
  $url = str_replace($seach_string, '../../',$file->full_path);
  
  if($file_type == 'pdf'){
  	echo '<embed src="'.$url.'" width=100% height=100%>';
  	
  }else if(in_array($file_type, array('gif', 'jpg', 'png', 'jpeg', 'PNG', 'GIF', 'JPG', 'JPEG'))){
  	echo '<img src="'.$url.'" width=100% height=100% >';
  
  }else if(in_array($file_type, array('avi','mp4','ogg', 'webM','ogv'))){
  ?>
  <video controls="controls" width="100%" height="100%" >
  <source src="<?php echo $url;?>" type="video/<?php echo $file_type;?>">
  	Your browser does not support HTML5 video.
  </video>
  <?php } else { echo "File not found!!!"; } ?>
  </div>
</div>	
<script type="text/javascript">

</script>