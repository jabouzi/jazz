<article class="module width_full">
	<header><h3>Worklows</h3></header>
	<form id="workflows_form" method="post" action="<?php echo site_url('workflow/process'); ?>">
		<div class="module_content">
			<fieldset>
				<label>Workflow Name</label>
				<label>Delete</label>
			</fieldset>
			<?php foreach ($workflows as $id => $name) : ?>
				<fieldset>
					<input type="text" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $name; ?>" data-validate="required" data-type="text" data-pos="1" title="Workflow Name">
					<input type="checkbox" id="delete[<?php echo $id; ?>]" name="delete[<?php echo $id; ?>]" value="1">
				</fieldset>
			<?php endforeach ?>
		</div>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_workflow" value="Save">
				<input type="button" id="add_workflow" value="Add">
				<span class="error_msg error_form_msg" style="display:none">required_fields</span>
			</div>
		</footer>
	</form>
	<div style="display:none" id="wokflow_add">
		<fieldset>
			<input type="text" id="" name="" value="">
			<input type="checkbox" id="" name="" value="">
		</fieldset>
	</div>
</article><!-- end of post new article -->
