<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('workflow.title'); ?></h3>
	</header>
	<form id="workflows_form" method="post" action="<?php echo site_url('workflow/process'); ?>">
		<div class="tab_container">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
					<th><?php echo lang('workflow.name'); ?></th> 
					<th><?php echo lang('workflow.order'); ?></th> 
					<th><?php echo lang('workflow.delete'); ?></th> 
				</tr> 
			</thead> 
			<tbody>
				<?php foreach ($workflows as $id => $workflow) : ?>
					<tr>
						<td><input type="text" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $workflow['name']; ?>" data-validate="required" data-type="text" data-pos="1" title="<?php echo lang('workflow.name'); ?>"></td>
						<td><input type="text" id="order[<?php echo $id; ?>]" name="order[<?php echo $id; ?>]" value="<?php echo $workflow['order']; ?>" data-validate="required" data-type="text" data-pos="1" title="<?php echo lang('workflow.order'); ?>"></td>
						<td><input type="checkbox" id="delete[<?php echo $id; ?>]" name="delete[<?php echo $id; ?>]" value="1">
					</tr>
				<?php endforeach ?>
			</tbody> 
			</table>
		</div><!-- end of .tab_container -->
		<footer>
			<div class="submit_link">
				<input type="button" id="save_workflow" value="<?php echo lang('admin.save'); ?>">
				<input type="button" id="add_workflow" value="<?php echo lang('admin.add'); ?>">
			</div>
		</footer>
	</form>
	<input type="hidden" id="error_message" value="<?php echo lang('workflow.error'); ?>">
	<input type="hidden" id="workflow_number" value="0">
	<div style="display:none" id="new_wokflow">
		<tr>
			<input type="text" name="new[]" value="">
		</tr>
	</div>
</article><!-- end of workflow manager article -->
