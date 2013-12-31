<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('permission.title'); ?></h3>
	</header>
	<form id="permissions_form" method="post" action="<?php echo site_url('permission/process'); ?>">
		<div class="tab_container">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
					<th><?php echo lang('permission.name'); ?></th> 
					<th><?php echo lang('permission.action'); ?></th> 
					<th><?php echo lang('permission.delete'); ?></th> 
				</tr> 
			</thead> 
			<tbody id="permission_list">
				<?php foreach ($permissions as $id => $permission) : ?>
					<tr>
						<td><input type="text" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $permission['name']; ?>" data-validate="required" data-type="text" data-pos="1" title="<?php echo lang('permission.name'); ?>"></td>
						<td><?php echo form_multiselect('actions['.$id.'][]', $actions, $permission['actions'], $attributes); ?></td>
						<td><input type="checkbox" id="delete[<?php echo $id; ?>]" name="delete[<?php echo $id; ?>]" value="1"></td>
					</tr>
				<?php endforeach ?>
			</tbody> 
			</table>
		</div><!-- end of .tab_container -->
		<footer>
			<div class="submit_link">
				<input type="button" id="save_permission" value="<?php echo lang('admin.save'); ?>">
				<input type="button" id="add_permission" value="<?php echo lang('admin.add'); ?>">
			</div>
		</footer>
	</form>
	<input type="hidden" id="error_message" value="<?php echo lang('permission.error'); ?>">
	<input type="hidden" id="permission_number" value="0">
	<div style="display:none" id="new_permission">
		<td><input type="text" name="new[]" value="">
	</div>
</article><!-- end of permission manager article -->
