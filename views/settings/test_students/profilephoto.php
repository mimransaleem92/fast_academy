<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" />
<link href="<?php echo base_url();?>assets/css/pages/profile.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url();?>assets/plugins/jcrop/css/jquery.Jcrop.min.css" rel="stylesheet"/>
<link href="<?php echo base_url();?>assets/css/pages/image-crop.css" rel="stylesheet"/>
<div class="row">
	<div class="col-md-12">
		<form action="<?php echo base_url().$model.'/profilephoto/'.$id.'?v=1';?>" id="demo8_form" role="form" method="post" enctype="multipart/form-data">
			<input type="hidden" id="crop_x" name="x" />
			<input type="hidden" id="crop_y" name="y" />
			<input type="hidden" id="crop_w" name="w" />
			<input type="hidden" id="crop_h" name="h" />
			<div class="form-group">
				<div class="thumbnail" id="imgsrc_div" >
					<?php
					$file_name = $id;
					$dir_path = 'assets/uploads/students/';
					$filetype_arr = array('.jpg', '.jpeg', '.png', '.gif');
					foreach($filetype_arr as $type){
						$filepath = $dir_path.$file_name.$type;
						if( file_exists($filepath)) {
							$file_name = $file_name.$type;
							break;
						}
						$filepath = '';
					}
					//echo $filepath;
					?>
					<img src="<?php if(!empty($filepath)) echo base_url().$filepath;?>" width="100%" height="100%" id="demo8" alt="">
				</div>
				
				<div class="margin-top-10 fileupload fileupload-new" data-provides="fileupload">
					<div class="input-group input-group-fixed">
						<span class="input-group-btn">
						<span class="uneditable-input">
						<i class="fa fa-file fileupload-exists"></i> 
						<span class="fileupload-preview"></span>
						</span>
						</span>
						<span class="btn default btn-file">
						<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>
						<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
						<input type="file" id="imgInp" name="crop_file" class="default" value="<?php if(isset($file_name)) echo $file_name;?>" />
						</span>
						<a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
					</div>
				</div>
				<span class="label label-danger">NOTE!</span>
				<span>
				Attached image thumbnail is
				supported in Latest Firefox, Chrome, Opera, 
				Safari and Internet Explorer 10 only. <br />Image should be 350x350.
				</span>
			</div>
			<div class="margin-top-10">
				<button type="submit" class="btn green" ><i class="fa fa-check"></i> Submit</button>
				
				<button type="button" class="btn default" onclick="window.open('<?php echo base_url().$model;?>', '_self')" ><?php echo Base_Controller::ToggleLang('Cancel');?></button>
			</div>
		</form>
	</div>
</div>


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jcrop/js/jquery.Jcrop.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/scripts/util.js"></script>
<script src="<?php echo base_url();?>assets/scripts/app.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>    
<script>
	jQuery(document).ready(function() {       
	   App.init();

	   function readURL(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();

               reader.onload = function (e) {
                   $('#demo8').attr('src', e.target.result);
               }

               reader.readAsDataURL(input.files[0]);
           }
       }

       //$("#imgInp").change(function(){
    	   //document.getElementById('demo8').src='assets/img/profile/profile-img.png';
    	 //  readURL(this);
       //});
	   
	   $('#demo8').Jcrop({
          aspectRatio: 1,
          onSelect: updateCoords
        });

        function updateCoords(c)
          {
            $('#crop_x').val(c.x);
            $('#crop_y').val(c.y);
            $('#crop_w').val(c.w);
            $('#crop_h').val(c.h);
          };

          /*$('#demo8_form').submit(function(){
            if (parseInt($('#crop_w').val())) return true;
            alert('Please select a crop region then press submit.');
           	return false;
            });*/
	   
	});