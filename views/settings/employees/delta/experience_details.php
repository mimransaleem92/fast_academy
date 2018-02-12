<div class="col-md-12">

	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption" ><?php echo Base_Controller::ToggleLang('Experience Detail');?></div>
			<div class="tools" onclick="showExpRow()" style="cursor: pointer;" > <?php echo Base_Controller::ToggleLang('Experience Detail', 'ar');?>
				<i class="fa fa-plus"></i> <?php echo Base_Controller::ToggleLang('Add Row');?>
			</div>
		</div>
		<div class="portlet-body" >
			<table id="tblProduct" class="table table-striped table-bordered table-hover table-full-width" >
            	<tbody>
            	<tr>
	            	<th style="text-align: center;">#</th>
	            	<th><?php echo Base_Controller::ToggleLang('Position /Designation');?></th>
	            	<th><?php echo Base_Controller::ToggleLang('Orgnization');?></th>
	            	<th><?php echo Base_Controller::ToggleLang('Period Details');?></th>
	            	<th style="text-align: right;"><?php echo Base_Controller::ToggleLang('Years of Experience');?></th>
            	</tr>
            	<?php for($i=1; $i<=10; $i++){ ?>
            	<tr id="exp_row_<?php echo $i;?>" >
	                <td width='5%' align="center" valign="middle"><?php echo $i;?></td>
					<td width='30%'><input type="text" id="position_<?php echo $i;?>" name="position[]" placeholder="Position" value="" style="width: 100%;" class="form-control form-control-inline" /></td>
					<td width='35%'><input type="text" id="orgnization_<?php echo $i;?>" name="orgnization[]" placeholder="Orgnization" value="" style="width: 100%;" class="form-control form-control-inline" /></td>
					<td width='15%'><input type="text" id="from_<?php echo $i;?>" name="from[]" placeholder="0" value="" style="width: 100%;" class="form-control form-control-inline" /></td>
					<td width='15%'><input type="text" id="years_experience_<?php echo $i;?>" name="years_experience[]" placeholder="0" value="" style="width: 100%;" class="form-control form-control-inline" /></td>
                </tr><?php }?>
                </tbody>
			</table>
			<div class="clearfix"></div>
		</div>
	</div>
</div>