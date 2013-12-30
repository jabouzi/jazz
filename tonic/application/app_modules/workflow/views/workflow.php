<article class="module width_full">
	<header><h3>Worklows</h3></header>
	<form method="post" action="<?php echo site_url('workflow/process'); ?>">
		<div class="module_content">
			<fieldset>
				<label>Workflow Name</label>
				<label>Delete</label>
			</fieldset>
			<?php foreach ($workflows as $id => $name) : ?>
				<fieldset>
					<input type="text" id="<?php echo $id; ?>" value="<?php echo $name; ?>">
					<input type="checkbox" id="delete[<?php echo $id; ?>]" value="">
				</fieldset>
			<?php endforeach ?>
		</div>
		<footer>
			<div class="submit_link">
				<input type="submit" value="Save">
				<input type="button" value="Add">
			</div>
		</footer>
	</form>
	<div style="display:none" id="wokflow_add">
		<fieldset>
			<input type="text" id="" value="">
			<input type="checkbox" id="" value="">
		</fieldset>
	</div>
</article><!-- end of post new article -->
