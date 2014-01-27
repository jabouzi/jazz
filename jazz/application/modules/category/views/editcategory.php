<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('category.edit'); ?></h3>
		<ul class="tabs">
			<?php foreach($languages as $language) : ?>
				<li><a href="#<?php echo $language->language_code; ?>"><?php echo ucfirst(strtolower($language->language_name)); ?></a></li>
			<? endforeach; ?>
		</ul>
	</header>
	<form id="category_profile" method="post" action="<?php echo site_url('category/process_editcategory'); ?>">
		<?php foreach($languages as $language) : ?>
			<?php $category = $categories[$language->language_id]; ?>
			<div id="<?php echo $language->language_code; ?>" class="tab_content">
				<div class="tab_container">
					<div class="module_content">
						<fieldset style="width:48%; float:left; margin-right: 3%;">
							<label><?php echo lang('category.parent'); ?></label>
							<?php echo form_dropdown('category_parent_id', $categories_list[$language->language_id], $category->category_parent_id, 'style="width:92%;"'); ?>
						</fieldset>
						<fieldset style="width:100%;">
							<label><?php echo lang('category.name'); ?></label>
							<input style="height: 30px;" type="text" name="category_name" id="category_name" value="<?php echo $category->category_name; ?>" data-validate="required" data-type="text" title="<?php echo lang('category.name'); ?>">
						</fieldset>
						<fieldset>
							<label><?php echo lang('category.url'); ?></label>
							<input style="height: 30px;" type="text" name="category_url" id="category_url" value="<?php echo $category->category_url; ?>" data-validate="required" data-type="text" title="<?php echo lang('category.url'); ?>">
						</fieldset>
						<fieldset style="width:48%; float:left; margin-right: 3%;">
							<label><?php echo lang('category.order'); ?></label>
							<input style="height: 30px;" type="text" name="category_order" id="category_order" value="<?php echo $category->category_order; ?>" data-validate="required" data-type="order" title="<?php echo lang('category.order'); ?>">
						</fieldset>
						<fieldset style="width:48%; float:left; margin-right: 3%;">
							<label><?php echo lang('category.status'); ?></label>
							<?php echo form_dropdown('category_active', $status, ord($category->category_active)); ?>
						</fieldset>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		<?php endforeach ?>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_category_profile" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
				<input type="hidden" name="category_id" id="category_id" value="<?php echo $category->category_id; ?>">
				<input type="hidden" id="category_exists_url" value="<?php echo site_url('category/url_exists'); ?>">
				<input type="hidden" id="active_lang" name="active_lang" value="en">
			</div>
		</footer>
	</form>
	<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
	<input type="hidden" id="error_message" value="">
</article><!-- end article -->
