<article class="module width_full">
	<header><h3>Worklows</h3></header>
		<div class="module_content">
			<fieldset>
				<label>Workflow Name</label>
			</fieldset>
			<?php foreach ($workflows as $id => $name) : ?>
				<fieldset>
					<input type="text" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $name; ?>">
				</fieldset>
			<?php endforeach ?>
		</div>
	<footer>
		<div class="submit_link">
			<input type="button" value="Save">
			<input type="button" value="Add">
		</div>
	</footer>
</article><!-- end of post new article -->
