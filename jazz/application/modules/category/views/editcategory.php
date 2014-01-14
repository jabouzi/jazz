<article class="module width_full">
	<header><h3><?php echo lang('category.edit'); ?></h3>
		<ul class="tabs">
			<?php foreach($languages as $language) : ?>
				<li><a href="#<?php echo $language->language_code; ?>"><?php echo ucfirst(strtolower($language->language_name)); ?></a></li>
			<? endforeach; ?>
		</ul>
	</header>
	<form id="category_profile" method="post" action="<?php echo site_url('category/process_editcategory'); ?>">
	<?php foreach($languages as $language) : ?>
		<div id="<?php echo $language->language_code; ?>" class="tab_content">
			<div class="module_content">
				<fieldset style="width:48%; float:left; margin-right: 3%;">
					<label><?php echo lang('category.parent'); ?></label>
					<?php echo form_dropdown('category_parent_id', $categories[$language->language_id], $category->category_parent_id, 'style="width:92%;"'); ?>
				</fieldset>
				<fieldset>
					<label><?php echo lang('category.name'); ?></label>
					<input type="text" name="category_name" id="category_name" value="<?php echo $category->category_name; ?>" data-validate="required" data-type="text" title="<?php echo lang('category.name'); ?>">
				</fieldset>
				<fieldset>
					<label><?php echo lang('category.url'); ?></label>
					<input type="text" name="category_url" id="category_url" value="<?php echo $category->category_url; ?>" data-validate="required" data-type="text" title="<?php echo lang('category.url'); ?>">
				</fieldset>
				<fieldset>
					<label><?php echo lang('category.order'); ?></label>
					<input type="text" name="category_order" id="category_order" value="<?php echo $category->category_order; ?>" data-validate="required" data-type="order" title="<?php echo lang('category.order'); ?>">
				</fieldset>
				<fieldset style="width:48%; float:left;">
					<label><?php echo lang('category.status'); ?></label>
					<?php echo form_dropdown('category_active', $status, ord($category->category_active)); ?>
				</fieldset>
				<div class="clear"></div>
			</div>
			<footer>
				<div class="submit_link">
					<input type="button" id="save_category_profile" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
					<input type="hidden" name="category_id" id="category_id" value="<?php echo $category->category_id; ?>">
					<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
					<input type="hidden" id="error_message" value="">
					<input type="hidden" id="category_exists_url" value="<?php echo site_url('category/url_exists'); ?>">
				</div>
			</footer>
		</div>
	<?php endforeach ?>
	</form>
</article><!-- end article -->
