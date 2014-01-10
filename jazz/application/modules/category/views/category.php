<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('category.categorys'); ?></h3>
		<ul class="tabs">
			<?php foreach($languages as $language) : ?>
				<li><a href="#<?php echo $language->language_code; ?>"><?php echo ucfirst(strtolower($language->language_name)); ?></a></li>
			<? endforeach; ?>
		</ul>
	</header>
	<form id="categories_form" method="post" action="<?php echo site_url('category/process'); ?>">
		<a href="<?php echo site_url().'/en/category/editcategory/1'; ?>">LINK</a>

		<footer>
				<div class="submit_link">
					<input type="button" id="save_category" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
					<input type="button" id="add_category" value="<?php echo lang('admin.add'); ?>">
				</div>
		</footer>
	</form>
	<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
	<input type="hidden" id="error_message" value="">
	<div style="display:none" id="new_language">
		<td><input type="text" name="new[]" value="">
	</div>
</article><!-- end of article -->
