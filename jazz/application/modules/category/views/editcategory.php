<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('category.edit'); ?></h3>
		<ul class="tabs">
			<?php foreach($languages as $language) : ?>
				<? if (!empty($categories[$language->language_id])) :?>
					<li><a href="#<?php echo $language->language_code; ?>"><?php echo ucfirst(strtolower($language->language_name)); ?></a></li>
				<? endif; ?>
			<? endforeach; ?>
		</ul>
	</header>
	<form id="category_profile" method="post" action="<?php echo site_url('category/process_editcategory'); ?>">
		<?php foreach($languages as $language) : ?>
			<? if (!empty($categories[$language->language_id])) :?>
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
			<? endif; ?>
		<?php endforeach ?>
		<footer>
			<div class="submit_link">
				<input type="button" id="save_category_profile" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
				<input type="button" id="add_language" value="<?php echo lang('admin.add'); ?>" class="alt_btn" data-toggle="modal" data-target="#addLanguage">
				<input type="hidden" name="category_id" id="category_id" value="<?php echo $category->category_id; ?>">
				<input type="hidden" id="category_exists_url" value="<?php echo site_url('category/url_exists'); ?>">
				<input type="hidden" id="active_lang" name="active_lang" value="en">
			</div>
		</footer>
	</form>
	<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
	<input type="hidden" id="error_message" value="">
</article><!-- end article -->

<div class="modal fade bs-modal-sm" id="addLanguage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo lang('language.add'); ?></h4>
      </div>
      <div class="modal-body">
        <p><label>English</label><input type="checkbox" value="1" name="en"></p>
        <p><label>Deutsch</label><input type="checkbox" value="1" name="de"></p>
        <p>
			<select name="lang">
				<option>English</option>
				<option>Deutsch</option>
			</select>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('admin.cancel'); ?></button>
        <button type="button" class="btn btn-primary"><?php echo lang('admin.save'); ?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
