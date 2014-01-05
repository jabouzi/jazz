<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('workflow.title'); ?></h3>
		<ul class="tabs">
			<?php foreach($admin_languages as $code => $admin_language) : ?>
				<li><a href="#<?php echo $code; ?>"><?php echo ucfirst(strtolower($admin_language)); ?></a></li>
			<? endforeach; ?>
		</ul>
	</header>
	<form id="workflows_form" method="post" action="<?php echo site_url('workflow/process'); ?>">
		<?php $index = 0; ?>
		<?php foreach($admin_languages as $code => $admin_language) : ?>
			<div id="<?php echo $code; ?>" class="tab_content">
				<div class="tab_container">
					<table class="tablesorter" cellspacing="0"> 
					<thead> 
						<tr> 
							<th><?php echo lang('workflow.name'); ?></th> 
							<th><?php echo lang('workflow.order'); ?></th>
							<?php if (!$index) : ?> 
								<th><?php echo lang('workflow.delete'); ?></th>
							<?php endif; ?> 
						</tr> 
					</thead> 
					<tbody id="workflow_list">
						<?php foreach ($workflows[$code] as $id => $workflow) : ?>
							<tr>
								<td><input type="text" id="workflow_name_<?php echo $code; ?>_<?php echo $workflow['id']; ?>" name="workflow_name[<?php echo $code; ?>][<?php echo $workflow['id']; ?>]" value="<?php echo $workflow['name']; ?>" data-validate="required" data-type="text" title="<?php echo lang('workflow.name'); ?>"></td>
								<?php if (!$index) : ?>
									<td><input type="text" id="order_<?php echo $workflow['id']; ?>" name="order[<?php echo $workflow['id']; ?>]" value="<?php echo $workflow['order']; ?>" data-validate="required" data-type="text" title="<?php echo lang('workflow.order'); ?>"></td>
									<td><input type="checkbox" id="delete_<?php echo $workflow['id']; ?>" name="delete[<?php echo $workflow['id']; ?>]" value="1"></td>
								<?php else : ?>
									<td><?php echo $workflow['order']; ?></td>
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
				<input type="button" id="save_workflow" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
				<input type="button" id="add_workflow" value="<?php echo lang('admin.add'); ?>">
				<input type="hidden" id="active_lang" name="active_lang" value="en">
			</div>
		</footer>
	</form>
	<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
	<input type="hidden" id="error_message" value="">
	<input type="hidden" id="workflow_number" value="0">
	<div style="display:none" id="new_workflow">
		<td><input type="text" name="new[]" value="">
	</div>
</article><!-- end of workflow manager article -->
