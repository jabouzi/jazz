<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('permission.title'); ?></h3>
		<ul class="tabs">
			<?php foreach($admin_languages as $code => $admin_language) : ?>
				<li><a href="#<?php echo $code; ?>"><?php echo ucfirst(strtolower($admin_language)); ?></a></li>
			<? endforeach; ?>
		</ul>
	</header>
	<form id="permissions_form" method="post" action="<?php echo site_url('permission/process'); ?>">
		<?php $index = 0; ?>
		<?php foreach($admin_languages as $code => $admin_language) : ?>
			<div id="<?php echo $code; ?>" class="tab_content">
				<div class="tab_container">
					<table class="tablesorter" cellspacing="0"> 
					<thead> 
						<tr> 
							<th><?php echo lang('permission.name'); ?></th>
							<th><?php echo lang('permission.action'); ?></th>
							<?php if (!$index) : ?> 
								<th><?php echo lang('permission.delete'); ?></th>
							<?php endif; ?> 
						</tr> 
					</thead> 
					<tbody id="permission_list">
						<?php foreach ($permissions[$code] as $id => $permission) : ?>
							<tr>
								<td><input type="text" id="permission_name_<?php echo $code; ?>_<?php echo $permission['id']; ?>" name="permission_name[<?php echo $code; ?>][<?php echo $permission['id']; ?>]" value="<?php echo $permission['name']; ?>" data-validate="required" data-type="text" title="<?php echo lang('permission.name'); ?>"></td>
								<?php if (!$index) : ?> 
									<td><?php echo form_multiselect('actions['.$permission['id'].'][]', $actions, $permission['actions'], $attributes); ?></td>
									<td><input type="checkbox" id="delete[<?php echo $permission['id']; ?>]" name="delete[<?php echo $permission['id']; ?>]" value="1"></td>
								<?php else : ?>
									<td></td>
								<?php endif; ?> 
							</tr>
						<?php endforeach ?>
					</tbody> 
					</table>
				</div><!-- end of .tab_container -->
			</div>			
			<?php $index++; ?>
		<?php endforeach; ?>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_permission" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
				<input type="button" id="add_permission" value="<?php echo lang('admin.add'); ?>">
				<input type="hidden" id="active_lang" name="active_lang" value="en">
			</div>
		</footer>
	</form>
	<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
	<input type="hidden" id="error_message" value="">
	<input type="hidden" id="permission_number" value="0">
	<div style="display:none" id="new_permission">
		<td><input type="text" name="new[]" value="">
	</div>
</article><!-- end of permission manager article -->
