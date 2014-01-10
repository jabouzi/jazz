<article class="module width_full">
	<header><h3 class="tabs_involved"><?php echo lang('category.categorys'); ?></h3>
		<ul class="tabs">
			<?php foreach($languages as $language) : ?>
				<li><a href="#<?php echo $language->language_code; ?>"><?php echo ucfirst(strtolower($language->language_name)); ?></a></li>
			<? endforeach; ?>
		</ul>
	</header>
	<form id="categories_form" method="post" action="<?php echo site_url('category/process'); ?>">
		<?php $index = 0; ?>
		<?php foreach($languages as $language) : ?>
			<div id="<?php echo $language->language_code; ?>" class="tab_content">
				<div class="tab_container">
					<table class="tablesorter" cellspacing="0"> 
					<thead> 
						<tr> 
							<th><?php echo lang('category.name'); ?></th>
							<?php if (!$index) : ?> 
								<th><?php echo lang('category.order'); ?></th>
								<th><?php echo lang('category.status'); ?></th>
								<th><?php echo lang('admin.action'); ?></th>
							<?php endif; ?>
						</tr> 
					</thead> 
					<tbody id="workflow_list">
						<?php foreach ($categories[$language->language_id] as $category) : ?>
							<?php if (isset($category->category_name)) var_dump($category->category_name); ?>
						<?php endforeach; ?>
					</tbody> 
					</table>
				</div><!-- end of .tab_container -->
			</div>
			<?php $index++; ?>
		<?php endforeach; ?>
		<footer>
				<div class="submit_link">
					<input type="button" id="save_language" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
					<input type="button" id="add_language" value="<?php echo lang('admin.add'); ?>">
				</div>
		</footer>
	</form>
	<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
	<input type="hidden" id="error_message" value="">
	<div style="display:none" id="new_language">
		<td><input type="text" name="new[]" value="">
	</div>
</article><!-- end of article -->
