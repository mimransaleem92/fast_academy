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
            	<?php $i = 1; 
            		foreach ($experience_list as $row){?>
            	<tr id="exp_row_<?php echo $i;?>" >
	                <td width='5%' align="center" valign="middle"><?php echo $i;?></td>
					<td width='30%'>
						<?php echo $row->position;?>
					</td>
					<td width='35%'><?php echo $row->orgnization;?></td>
					<td width='15%'><?php echo util::displayFormat($row->from) . ' to ' . util::displayFormat($row->to);?></td>
					<td width='15%'><?php echo $row->years_experience;?></td>
                </tr><?php  $i++; }
                
                	for($i; $i<=10; $i++){ ?>
            	<tr id="exp_row_<?php echo $i;?>" >
	                <td width='5%' align="center" valign="middle"><?php echo $i;?></td>
					<td width='30%'><input type="text" id="position_<?php echo $i;?>" name="position[]" placeholder="Position" value="" style="width: 100%;" class="form-control form-control-inline" /></td>
					<td width='35%'><input type="text" id="orgnization_<?php echo $i;?>" name="orgnization[]" placeholder="Orgnization" value="" style="width: 100%;" class="form-control form-control-inline" /></td>
					<td width='15%'><input type="text" id="from_<?php echo $i;?>" name="from[]" placeholder="0" value="" style="width: 100%;" class="form-control form-control-inline" /></td>
					<td width='15%'><input type="text" id="years_experience_<?php echo $i;?>" name="years_experience[]" placeholder="0" value="" style="width: 100%;" class="form-control form-control-inline" /></td>
                </tr><?php }?>
                </tbody>
			</table>
			<div class="row">
				<div class="col-md-5">
					<button type="button" class="btn blue" onclick="submitForm()" ><i class="fa fa-check"></i> Submit</button>
					<button type="button" class="btn default" onclick="window.open('<?php echo base_url().$model;?>', '_self')" >Cancel</button>
				</div>
				<div class="col-md-offset-2 col-md-5"> </div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>