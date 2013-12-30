<article class="module width_full">
	<header><h3><?php echo lang('permission.title'); ?></h3></header>
	<form id="permissions_form" method="post" action="<?php echo site_url('permission/process'); ?>">
		<div class="module_content" id="permission_list">
			<fieldset>
				<label style="width:60%;" ><?php echo lang('permission.name'); ?></label>
				<label style="width:15%;"><?php echo lang('permission.order'); ?></label>
				<label><?php echo lang('admin.delete'); ?></label>
			</fieldset>
			<?php foreach ($permissions as $id => $permission) : ?>
				<fieldset>
					<input style="width:60%; padding-left: 0;" type="text" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $permission['name']; ?>" data-validate="required" data-type="text" data-pos="1" title="<?php echo lang('permission.name'); ?>">
					<input type="checkbox" id="delete[<?php echo $id; ?>]" name="delete[<?php echo $id; ?>]" value="1">
				</fieldset>
			<?php endforeach ?>
		</div>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_permission" value="<?php echo lang('admin.save'); ?>">
				<input type="button" id="add_permission" value="<?php echo lang('admin.add'); ?>">
			</div>
		</footer>
	</form>
	<input type="hidden" id="error_message" value="<?php echo lang('permission.error'); ?>">
	<input type="hidden" id="permission_number" value="0">
	<div style="display:none" id="new_wokflow">
		<fieldset>
			<input type="text" name="new[]" value="">
		</fieldset>
	</div>
</article><!-- end of post new article -->
