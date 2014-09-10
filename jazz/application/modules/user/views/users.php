<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-content">
				<div id="tabs">
					<table class="table table-striped"> 
						<thead> 
							<tr> 
								<th><?php echo lang('user.firstname'); ?></th>
								<th><?php echo lang('user.lastname'); ?></th>
								<th><?php echo lang('user.email'); ?></th>
								<th><?php echo lang('user.status'); ?></th>
								<th><?php echo lang('admin.action'); ?></th>
							</tr> 
						</thead> 
						<tbody id="workflow_list">
							<?php foreach ($user->result() as $item) : ?>
								<tr>
									<td><?php echo $item->user_firstname ?></td>
									<td><?php echo $item->user_lastname ?></td>
									<td><?php echo $item->user_email ?></td>
									<td><span class="<?php echo $status[ord($item->user_active)]; ?>" title="<?php echo lang('admin.status'.ord($item->user_active)); ?>"></span></td>
									<td>
										<?php echo anchor('user/edituser/'.$item->user_id, '&nbsp;', array('class' => "fa fa-edit", 'title' => lang('user.edit'))); ?>
										<?php echo anchor('user/deleteuser/'.$item->user_id, '&nbsp;', array('class' => "fa fa-trash-o", 'title' => lang('user.delete'))); ?>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody> 
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
