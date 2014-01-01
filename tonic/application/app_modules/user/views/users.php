<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('user.users'); ?></h3>
	</header>
	<form id="workflows_form" method="post" action="<?php echo site_url('workflow/process'); ?>">
		<div class="tab_container">
			<table class="tablesorter" cellspacing="0"> 
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
						<td><?php echo $item->user_status ?></td>
						<td>
							<a href="users/edituser/<?php echo $item->user_id; ?>"><input type="image" src="/tonic/assets/images/icn_edit.png" title="<?php echo lang('user.edit'); ?>"></a>
							<input type="image" src="/tonic/assets/images/icn_trash.png" title="<?php echo lang('user.delete'); ?>">
						</td>
					</tr>
				<?php endforeach ?>
			</tbody> 
			</table>
		</div><!-- end of .tab_container -->
	</form>
	<input type="hidden" id="error_message" value="<?php echo lang('workflow.error'); ?>">
	<input type="hidden" id="workflow_number" value="0">
	<div style="display:none" id="new_workflow">
		<td><input type="text" name="new[]" value="">
	</div>
</article><!-- end of workflow manager article -->
