<table class="table table-striped table-bordered table-hover table-full-width" >
	<thead>
		<tr>
			<th>#</th>
			<th><?php echo Base_Controller::ToggleLang('File');?></th>
			<th><?php echo Base_Controller::ToggleLang('Date Time');?></th>
			<?php if(sizeof($files)>1){ ?>
			<th><a class="btn btn-xs green" href="<?php echo base_url().$model.'/download_zip/'.$form->employee_id; ?>" target="_blank" >
				Download All <i class="fa fa-download">
				</i></a>
			</th>
			<?php } ?>
		</tr>
		</thead>
		<tbody>
                  	<?php $lec_count = 0;
                  	if(sizeof($files)>0){
						foreach ($files as $values) {
                        	$lec_count++;
                    ?>
                          <tr id="file_row<?php echo $values->upload_file_log_id;?>">
                            <td style="color:#888888;"><strong><?php echo $lec_count;?></strong></td>
                            <td ><?php echo (strlen($values->client_name) > 35) ? substr($values->client_name, 0, 35) : $values->client_name;?></td>
                            <td ><?php echo Util::dateDisplayFormateWithTime($values->created_date);?></td>
                            <td >
                            	<a class="btn default btn-xs red-stripe" href="<?php echo base_url().$model.'/view_file/'.$values->form_log_id.'?f='.$values->upload_file_log_id; ?>" target="_blank" > View </a>
                            	<a class="btn btn-xs green" href="<?php echo base_url().$model.'/download_file/'.$values->form_log_id.'?f='.$values->upload_file_log_id; ?>" target="_blank" >
								Download <i class="fa fa-download">
								</i>
								</a>
								<?php if ($action_menu == 1) { ?>
								<a class="btn default btn-xs red-stripe" href="#" onclick="del_lecture_file('<?php echo $values->upload_file_log_id."', '".$values->orig_name;?>')" > Delete </a>
								<?php }?>
                            </td>
                          </tr>
                  <?php	}
					}else{
                  		echo "<tr><td colspan='3'> No Attachment Found!! </td></tr>";
					}?>
	</tbody>
</table>