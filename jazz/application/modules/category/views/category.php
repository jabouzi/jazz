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
							<th><?php echo lang('category.order'); ?></th>
							<th><?php echo lang('category.status'); ?></th>
							<th><?php echo lang('admin.action'); ?></th>
						</tr> 
					</thead> 
					<tbody id="workflow_list">
						<?php if (element($language->language_id, $structures) ): ?>
							<?php foreach ($structures[$language->language_id] as $category_id => $structure) : ?>
								<?php $category = $categories[$language->language_id][$category_id]; ?>
								<tr>
									<?php if (trim($category->category_name) == '') : ?>
										<td><?php echo str_repeat('<span class="dash_space"><nobr>|—</nobr></span>', $structure) ?><input type="text" name="name[<?php echo $category->language_id ; ?>][<?php echo $category->category_id ; ?>]" value=""></td>
									<?php else :?>
										<td><?php echo str_repeat('<span class="dash_space"><nobr>|—</nobr></span>', $structure) . $category->category_name ; ?></td>
									<?php endif ?>
									<td><input type="text" name="order[<?php echo $category->category_id ; ?>]" maxlength="2" size="2" value="<?php echo  $category->category_order ; ?>"></td>
									<td><img src="/jazz/assets/images/<?php echo $status[ord($category->category_active)]; ?>" title="<?php echo lang('category.status'); ?>"></td>
									<td>
										<?php echo anchor('category/editcategory/'.$category->category_id, '<img src="/jazz/assets/images/icn_edit.png" title="'.lang('category.edit').'">'); ?>
										<?php echo anchor('category/deletecategory/'.$category->category_id, '<img src="/jazz/assets/images/icn_trash.png" title="'.lang('category.delete').'">'); ?>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody> 
					</table>
				</div><!-- end of .tab_container -->
			</div>
			<?php $index++; ?>
		<?php endforeach; ?>
		<footer>
				<div class="submit_link">
					<input type="button" id="save_category" value="<?php echo lang('admin.save'); ?>" class="submit_form alt_btn">
					<input type="button" id="add_category" value="<?php echo lang('admin.add'); ?>">
				</div>
		</footer>
	</form>
	<input type="hidden" id="admin_error" value="<?php echo lang('admin.error'); ?>">
	<input type="hidden" id="error_message" value="">
	<input type="hidden" id="active_lang" name="active_lang" value="en">
	<div style="display:none" id="new_language">
		<td><input type="text" name="new[]" value="">
	</div>
</article><!-- end of article -->
