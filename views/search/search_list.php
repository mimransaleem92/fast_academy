	
	<table class="table table-striped table-bordered table-advance table-hover" >
		<caption style="text-align: right; padding-right: 10px;"><?php if(isset($student_list) && sizeof($student_list) > 0){ echo 'Total Students: '. sizeof($student_list); }?></caption>
		<thead>
			<tr>
				<th><?php echo Base_Controller::ToggleLang('SR #');?></th>
				<th><?php echo Base_Controller::ToggleLang('Admintion #');?></th>
				<th><?php echo Base_Controller::ToggleLang('Name');?></th>
				<th><?php echo Base_Controller::ToggleLang('Father Name');?></th>
				<th><?php echo Base_Controller::ToggleLang('Grade/Sec');?></th>
				<th><?php echo Base_Controller::ToggleLang('Mother Mobile #');?></th>
				<th><?php echo Base_Controller::ToggleLang('Father Mobile #');?></th>
				<th></th>
			</tr>
		</thead>
		<tbody>	
        <?php
        	$i=0;
            if(isset($student_list) && sizeof($student_list) > 0){
            foreach($student_list as $values){ $i++;
            	$row_color = "";
            	$url = base_url().'students/student_profile/'.$values->student_id;
            	if($values->cdel == '1'){
            		$url = '#';
            		$row_color = "style='color: red;'";
            	}
            ?>
            <tr <?php echo $row_color;?> >
            	<td style="color:#888888;text-align:center"><strong><?php echo $i; ?></strong></td>
              	<td nowrap="nowrap">
              		<?php if($url=="#") { echo $values->admission_number; } else {?>
              		<a href="<?php echo $url;?>"><?php echo $values->admission_number?></a>
              		<?php } ?>
              	</td>
				<td ><?php echo empty($values->student_name) ? '<span style="font-family:tahoma">'.$values->student_name_ar.'</span>' : $values->student_name?></td>
             	<td><?php echo $values->father_name; ?></td>
             	<td><?php echo $values->course_name. ' - ' . $values->section;?></td>	                            
             	<td><?php echo $values->cell_phone_mother;?></td>
              	<td><?php echo $values->cell_phone_father;?></td>
              	<td>
              		<?php if($row_color == ""){ 
              					if($admin_role >= 2){?>
              		<a href="javascript:;" class="btn default btn-xs blue-stripe" onclick="window.open('<?php echo base_url().'students/edit/'.$values->student_id;?>', '_self')" >Update</a>
              		<?php 		} 
              			  }else{?>
              		<a href="javascript:;" class="btn default btn-xs red-stripe disabled" >Deleted</a>
              			<?php if($admin_role >= 3) {?>
              			<a href="javascript:;" class="btn default btn-xs green-stripe" onclick="window.open('<?php echo base_url().'students/enable_student/'.$values->student_id;?>', '_self')" >Activate</a>
              		<?php 	  }
            			} ?>
              	</td>
        	</tr>
            <?php 	}
            }
            ?></tbody>
	</table>
	<input type="hidden" id="count" value="<?php echo $i;?>"/>